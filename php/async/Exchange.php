<?php


namespace ccxt\async;

use ccxt;

// rounding mode
const TRUNCATE = ccxt\TRUNCATE;
const ROUND = ccxt\ROUND;
const ROUND_UP = ccxt\ROUND_UP;
const ROUND_DOWN = ccxt\ROUND_DOWN;

// digits counting mode
const DECIMAL_PLACES = ccxt\DECIMAL_PLACES;
const SIGNIFICANT_DIGITS = ccxt\SIGNIFICANT_DIGITS;
const TICK_SIZE = ccxt\TICK_SIZE;

// padding mode
const NO_PADDING = ccxt\NO_PADDING;
const PAD_WITH_ZERO = ccxt\PAD_WITH_ZERO;

use React;
use Recoil;

use Generator;
use Exception;

include 'Throttle.php';

$version = '1.86.1';

class Exchange extends \ccxt\Exchange {

    const VERSION = '1.86.1';

    public static $loop;
    public static $kernel;
    public $browser;
    public $marketsLoading = null;
    public $reloadingMarkets = null;
    public $tokenBucket;
    public $throttle;

    public static function get_loop() {
        return React\EventLoop\Loop::get();
    }

    public static function get_kernel() {
        if (!static::$kernel) {
            static::$kernel = Recoil\React\ReactKernel::create(static::get_loop());
        }
        return static::$kernel;
    }

    public static function execute_and_run($arg) {
        $kernel = static::get_kernel();
        $kernel->execute($arg);
        $kernel->run();
    }

    public function __construct($options = array()) {
        if (!class_exists('React\\EventLoop\\Factory')) {
            throw new ccxt\NotSupported("React is not installed\n\ncomposer require --ignore-platform-reqs react/http:\"^1.4.0\"\n\n");
        }
        if (!class_exists('Recoil\\React\\ReactKernel')) {
            throw new ccxt\NotSupported("Recoil is not installed\n\ncomposer require --ignore-platform-reqs recoil/react:\"1.0.2\"\n\n");
        }
        $config = $this->omit($options, array('loop', 'kernel'));
        parent::__construct($config);
        // we only want one instance of the loop and one instance of the kernel
        if (static::$loop === null) {
            if (array_key_exists('loop', $options)) {
                static::$loop = $options['loop'];
            } else {
                static::$loop = static::get_loop();
            }
        } else if (array_key_exists('loop', $options)) {
            throw new Exception($this->id . ' cannot use two different loops');
        }

        if (static::$kernel === null) {
            if (array_key_exists('kernel', $options)) {
                static::$kernel = $options['kernel'];
            } else {
                static::$kernel = Recoil\React\ReactKernel::create(static::$loop);
            }
        } else if (array_key_exists('kernel', $options)) {
            throw new Exception($this->id . ' cannot use two different loops');
        }

        $connector = new React\Socket\Connector(static::$loop, array(
            'timeout' => $this->timeout,
        ));
        if ($this->browser === null) {
            $this->browser = (new React\Http\Browser(static::$loop, $connector))->withRejectErrorResponse(false);
        }
        $this->throttle = new Throttle($this->tokenBucket, static::$kernel);
    }

    public function fetch($url, $method = 'GET', $headers = null, $body = null) {

        $headers = array_merge($this->headers, $headers ? $headers : array());
        if (!$headers) {
            $headers = array();
        }

        if (strlen($this->proxy)) {
            $headers['Origin'] = $this->origin;
        }

        if ($this->userAgent) {
            if (gettype($this->userAgent) == 'string') {
                $headers['User-Agent'] = $this->userAgent;
            } elseif ((gettype($this->userAgent) == 'array') && array_key_exists('User-Agent', $this->userAgent)) {
                $headers['User-Agent'] = $this->userAgent['User-Agent'];
            }
        }

        // this name for the proxy string is deprecated
        // we should rename it to $this->cors everywhere
        $url = $this->proxy . $url;

        if ($this->verbose) {
            print_r(array('fetch Request:', $this->id, $method, $url, 'RequestHeaders:', $headers, 'RequestBody:', $body));
        }

        $this->lastRestRequestTimestamp = $this->milliseconds();

        try {
            $result = yield $this->browser->request($method, $url, $headers, $body);
        } catch (Exception $e) {
            $message = $e->getMessage();
            if (strpos($message, 'timed out') !== false) { // no way to determine this easily https://github.com/clue/reactphp-buzz/issues/146
                throw new ccxt\RequestTimeout(implode(' ', array($url, $method, 28, $message))); // 28 for compatibility with CURL
            } else if (strpos($message, 'DNS query') !== false) {
                throw new ccxt\NetworkError($message);
            } else {
                throw new ccxt\ExchangeError($message);
            }
        }

        $raw_response_headers = $result->getHeaders();
        $raw_header_keys = array_keys($raw_response_headers);
        $response_headers = array();
        foreach ($raw_header_keys as $header) {
            $response_headers[$header] = $result->getHeaderLine($header);
        }
        $http_status_code = $result->getStatusCode();
        $http_status_text = $result->getReasonPhrase();
        $response_body = strval($result->getBody());

        $response_body = $this->on_rest_response($http_status_code, $http_status_text, $url, $method, $response_headers, $response_body, $headers, $body);

        if ($this->enableLastHttpResponse) {
            $this->last_http_response = $response_body;
        }

        if ($this->enableLastResponseHeaders) {
            $this->last_response_headers = $response_headers;
        }

        if ($this->verbose) {
            print_r(array('fetch Response:', $this->id, $method, $url, $http_status_code, 'ResponseHeaders:', $response_headers, 'ResponseBody:', $response_body));
        }

        $json_response = null;
        $is_json_encoded_response = $this->is_json_encoded_object($response_body);

        if ($is_json_encoded_response) {
            $json_response = $this->parse_json($response_body);
            if ($this->enableLastJsonResponse) {
                $this->last_json_response = $json_response;
            }
        }

        $this->handle_errors($http_status_code, $http_status_text, $url, $method, $response_headers, $response_body, $json_response, $headers, $body);
        $this->handle_http_status_code($http_status_code, $http_status_text, $url, $method, $response_body);

        return isset($json_response) ? $json_response : $response_body;
    }

    public function fetch2($path, $api = 'public', $method = 'GET', $params = array(), $headers = null, $body = null, $config = array(), $context = array()) {
        if ($this->enableRateLimit) {
            $cost = $this->calculate_rate_limiter_cost($api, $method, $path, $params, $config, $context);
            yield call_user_func($this->throttle, $cost);
        }
        $request = $this->sign($path, $api, $method, $params, $headers, $body);
        return yield $this->fetch($request['url'], $request['method'], $request['headers'], $request['body']);
    }

    public function fetch_permissions($params = array()) {
        throw new NotSupported($this->id . ' fetch_permissions() is not supported yet');
    }


    public function load_markets_helper($reload = false, $params = array()) {
        // copied from js
        if (!$reload && $this->markets) {
            if (!$this->markets_by_id) {
                return $this->set_markets ($this->markets);
            }
            return $this->markets;
        }
        $currencies = null;
        if (array_key_exists('fetchCurrencies', $this->has) && $this->has['fetchCurrencies'] === true) {
            $currencies = yield $this->fetch_currencies ();
        }
        $markets = yield $this->fetch_markets ($params);
        return $this->set_markets ($markets, $currencies);
    }

    public function loadMarkets($reload = false, $params = array()) {
        return yield $this->load_markets($reload, $params);
    }

    public function load_markets($reload = false, $params = array()) {
        if (($reload && !$this->reloadingMarkets) || !$this->marketsLoading) {
            $this->reloadingMarkets = true;
            $this->marketsLoading = static::$kernel->execute($this->load_markets_helper($reload, $params))->promise()->then(function ($resolved) {
                $this->reloadingMarkets = false;
                return $resolved;
            }, function ($error) {
                $this->reloadingMarkets = false;
                throw $error;
            });
        }
        return $this->marketsLoading;
    }

    public function loadAccounts($reload = false, $params = array()) {
        return yield $this->load_accounts($reload, $params);
    }

    public function load_accounts($reload = false, $params = array()) {
        if ($reload) {
            $this->accounts = yield $this->fetch_accounts($params);
        } else {
            if ($this->accounts) {
                yield;
                return $this->accounts;
            } else {
                $this->accounts = yield $this->fetch_accounts($params);
            }
        }
        $this->accountsById = static::index_by($this->accounts, 'id');
        return $this->accounts;
    }

    public function fetch_l2_order_book($symbol, $limit = null, $params = array()) {
        $orderbook = yield $this->fetch_order_book($symbol, $limit, $params);
        return array_merge($orderbook, array(
            'bids' => $this->sort_by($this->aggregate($orderbook['bids']), 0, true),
            'asks' => $this->sort_by($this->aggregate($orderbook['asks']), 0),
        ));
    }

    public function fetch_partial_balance($part, $params = array()) {
        $balance = yield $this->fetch_balance($params);
        return $balance[$part];
    }

    public function load_trading_limits($symbols = null, $reload = false, $params = array()) {
        yield;
        if ($this->has['fetchTradingLimits']) {
            if ($reload || !(is_array($this->options) && array_key_exists('limitsLoaded', $this->options))) {
                $response = yield $this->fetch_trading_limits($symbols);
                // $limits = $response['limits'];
                // $keys = is_array ($limits) ? array_keys ($limits) : array ();
                for ($i = 0; $i < count($symbols); $i++) {
                    $symbol = $symbols[$i];
                    $this->markets[$symbol] = array_replace_recursive($this->markets[$symbol], $response[$symbol]);
                }
                $this->options['limitsLoaded'] = $this->milliseconds();
            }
        }
        return $this->markets;
    }

    public function fetch_ohlcv($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array()) {
        if (!$this->has['fetchTrades']) {
            throw new NotSupported($this->id . ' fetch_ohlcv() is not supported yet');
        }
        yield $this->load_markets();
        $trades = yield $this->fetch_trades($symbol, $since, $limit, $params);
        return $this->build_ohlcv($trades, $timeframe, $since, $limit);
    }

    public function fetch_status($params = array()) {
        if ($this->has['fetchTime']) {
            $time = yield $this->fetch_time($params);
            $this->status = array_merge($this->status, array(
                'updated' => $time,
            ));
        }
        return $this->status;
    }

    public function create_limit_order($symbol, $side, $amount, $price, $params = array()) {
        return yield $this->create_order($symbol, 'limit', $side, $amount, $price, $params);
    }

    public function create_market_order($symbol, $side, $amount, $price = null, $params = array()) {
        return yield $this->create_order($symbol, 'market', $side, $amount, $price, $params);
    }

    public function create_limit_buy_order($symbol, $amount, $price, $params = array()) {
        return yield $this->create_order($symbol, 'limit', 'buy', $amount, $price, $params);
    }

    public function create_limit_sell_order($symbol, $amount, $price, $params = array()) {
        return yield $this->create_order($symbol, 'limit', 'sell', $amount, $price, $params);
    }

    public function create_market_buy_order($symbol, $amount, $params = array()) {
        return yield $this->create_order($symbol, 'market', 'buy', $amount, null, $params);
    }

    public function create_market_sell_order($symbol, $amount, $params = array()) {
        return yield $this->create_order($symbol, 'market', 'sell', $amount, null, $params);
    }

    public function edit_order($id, $symbol, $type, $side, $amount, $price = null, $params = array()) {
        yield $this->cancel_order($id, $symbol, $params);
        return yield $this->create_order($symbol, $type, $side, $amount, $price, $params);
    }

    public function fetch_deposit_address($code, $params = array()) {
        if ($this->has['fetchDepositAddresses']) {
            $deposit_addresses = yield $this->fetch_deposit_addresses(array($code), $params);
            $deposit_address = $this->safe_value($deposit_addresses, $code);
            if ($deposit_address === null) {
                throw new InvalidAddress($this->id . ' fetchDepositAddress could not find a deposit address for ' . $code . ', make sure you have created a corresponding deposit address in your wallet on the exchange website');
            } else {
                return $deposit_address;
            }
        } else {
            throw new NotSupported ($this->id . ' fetchDepositAddress() is not supported yet');
        }
    }

    public function fetch_ticker($symbol, $params = array ()) {
        if ($this->has['fetchTickers']) {
            $tickers = yield $this->fetch_tickers(array( $symbol ), $params);
            $ticker = $this->safe_value($tickers, $symbol);
            if ($ticker === null) {
                throw new NullResponse($this->id . ' fetchTickers() could not find a $ticker for ' . $symbol);
            } else {
                return $ticker;
            }
        } else {
            throw new NotSupported($this->id . ' fetchTicker() is not supported yet');
        }
    }

    public function sleep($milliseconds) {
        $time = $milliseconds / 1000;
        $loop = $this->get_loop();
        $timer = null;
        return new React\Promise\Promise(function ($resolve) use ($loop, $time, &$timer) {
            $timer = $loop->addTimer($time, function () use ($resolve) {
                $resolve(null);
            });
        });
    }

    // METHODS BELOW THIS LINE ARE TRANSPILED FROM JAVASCRIPT TO PYTHON AND PHP

    public function load_time_difference($params = array ()) {
        $serverTime = yield $this->fetchTime ($params);
        $after = $this->milliseconds ();
        $this->options['timeDifference'] = $after - $serverTime;
        return $this->options['timeDifference'];
    }

    public function implode_hostname($url) {
        return $this->implode_params($url, array( 'hostname' => $this->hostname ));
    }

    public function fetch_market_leverage_tiers($symbol, $params = array ()) {
        if ($this->has['fetchLeverageTiers']) {
            $market = yield $this->market ($symbol);
            if (!$market['contract']) {
                throw new BadSymbol($this->id . ' fetchMarketLeverageTiers() supports contract markets only');
            }
            $tiers = yield $this->fetch_leverage_tiers(array( $symbol ));
            return $this->safe_value($tiers, $symbol);
        } else {
            throw new NotSupported($this->id . ' fetchMarketLeverageTiers() is not supported yet');
        }
    }

    public function create_post_only_order($symbol, $type, $side, $amount, $price, $params = array ()) {
        if (!$this->has['createPostOnlyOrder']) {
            throw new NotSupported($this->id . 'createPostOnlyOrder() is not supported yet');
        }
        $query = array_merge($params, array( 'postOnly' => true ));
        return yield $this->create_order($symbol, $type, $side, $amount, $price, $query);
    }

    public function create_reduce_only_order($symbol, $type, $side, $amount, $price, $params = array ()) {
        if (!$this->has['createReduceOnlyOrder']) {
            throw new NotSupported($this->id . 'createReduceOnlyOrder() is not supported yet');
        }
        $query = array_merge($params, array( 'reduceOnly' => true ));
        return yield $this->create_order($symbol, $type, $side, $amount, $price, $query);
    }

    public function create_stop_order($symbol, $type, $side, $amount, $price = null, $stopPrice = null, $params = array ()) {
        if (!$this->has['createStopOrder']) {
            throw new NotSupported($this->id . ' createStopOrder() is not supported yet');
        }
        if ($stopPrice === null) {
            throw new ArgumentsRequired($this->id . ' create_stop_order() requires a $stopPrice argument');
        }
        $query = array_merge($params, array( 'stopPrice' => $stopPrice ));
        return yield $this->create_order($symbol, $type, $side, $amount, $price, $query);
    }

    public function create_stop_limit_order($symbol, $side, $amount, $price, $stopPrice, $params = array ()) {
        if (!$this->has['createStopLimitOrder']) {
            throw new NotSupported($this->id . ' createStopLimitOrder() is not supported yet');
        }
        $query = array_merge($params, array( 'stopPrice' => $stopPrice ));
        return yield $this->create_order($symbol, 'limit', $side, $amount, $price, $query);
    }

    public function create_stop_market_order($symbol, $side, $amount, $stopPrice, $params = array ()) {
        if (!$this->has['createStopMarketOrder']) {
            throw new NotSupported($this->id . ' createStopMarketOrder() is not supported yet');
        }
        $query = array_merge($params, array( 'stopPrice' => $stopPrice ));
        return yield $this->create_order($symbol, 'market', $side, $amount, null, $query);
    }

    public function safe_currency_code($currencyId, $currency = null) {
        $currency = $this->safe_currency($currencyId, $currency);
        return $currency['code'];
    }

    public function filter_by_symbol_since_limit($array, $symbol = null, $since = null, $limit = null, $tail = false) {
        return $this->filter_by_value_since_limit($array, 'symbol', $symbol, $since, $limit, 'timestamp', $tail);
    }

    public function filter_by_currency_since_limit($array, $code = null, $since = null, $limit = null, $tail = false) {
        return $this->filter_by_value_since_limit($array, 'currency', $code, $since, $limit, 'timestamp', $tail);
    }

    public function parse_borrow_interests($response, $market = null) {
        $interests = array();
        for ($i = 0; $i < count($response); $i++) {
            $row = $response[$i];
            $interests[] = $this->parse_borrow_interest($row, $market);
        }
        return $interests;
    }

    public function parse_funding_rate_histories($response, $market = null, $since = null, $limit = null) {
        $rates = array();
        for ($i = 0; $i < count($response); $i++) {
            $entry = $response[$i];
            $rates[] = $this->parse_funding_rate_history($entry, $market);
        }
        $sorted = $this->sort_by($rates, 'timestamp');
        $symbol = ($market === null) ? null : $market['symbol'];
        return $this->filter_by_symbol_since_limit($sorted, $symbol, $since, $limit);
    }

    public function safe_symbol($marketId, $market = null, $delimiter = null) {
        $market = $this->safe_market($marketId, $market, $delimiter);
        return $market['symbol'];
    }

    public function parse_funding_rate($contract, $market = null) {
        throw new NotSupported($this->id . ' parseFundingRate() is not supported yet');
    }

    public function parse_funding_rates($response, $market = null) {
        $result = array();
        for ($i = 0; $i < count($response); $i++) {
            $parsed = $this->parse_funding_rate($response[$i], $market);
            $result[$parsed['symbol']] = $parsed;
        }
        return $result;
    }

    public function is_post_only($isMarketOrder, $exchangeSpecificParam, $params = array ()) {
        /**
         * @ignore
         * @param {string} type Order type
         * @param {boolean} $exchangeSpecificParam exchange specific $postOnly
         * @param {dict} $params exchange specific $params
         * @return {boolean} true if a post only order, false otherwise
         */
        $timeInForce = $this->safe_string_upper($params, 'timeInForce');
        $postOnly = $this->safe_value_2($params, 'postOnly', 'post_only', false);
        // we assume $timeInForce is uppercase from safeStringUpper ($params, 'timeInForce')
        $ioc = $timeInForce === 'IOC';
        $fok = $timeInForce === 'FOK';
        $timeInForcePostOnly = $timeInForce === 'PO';
        $postOnly = $postOnly || $timeInForcePostOnly || $exchangeSpecificParam;
        if ($postOnly) {
            if ($ioc || $fok) {
                throw new InvalidOrder($this->id . ' $postOnly orders cannot have $timeInForce equal to ' . $timeInForce);
            } elseif ($isMarketOrder) {
                throw new InvalidOrder($this->id . ' market orders cannot be postOnly');
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function fetch_trading_fees($params = array ()) {
        throw new NotSupported($this->id . ' fetchTradingFees() is not supported yet');
    }

    public function fetch_trading_fee($symbol, $params = array ()) {
        if (!$this->has['fetchTradingFees']) {
            throw new NotSupported($this->id . ' fetchTradingFee() is not supported yet');
        }
        return yield $this->fetch_trading_fees($params);
    }

    public function parse_open_interest($interest, $market = null) {
        throw new NotSupported($this->id . ' parseOpenInterest () is not supported yet');
    }

    public function parse_open_interests($response, $market = null, $since = null, $limit = null) {
        $interests = array();
        for ($i = 0; $i < count($response); $i++) {
            $entry = $response[$i];
            $interest = $this->parse_open_interest($entry, $market);
            $interests[] = $interest;
        }
        $sorted = $this->sort_by($interests, 'timestamp');
        $symbol = $this->safe_string($market, 'symbol');
        return $this->filter_by_symbol_since_limit($sorted, $symbol, $since, $limit);
    }

    public function fetch_funding_rate($symbol, $params = array ()) {
        if ($this->has['fetchFundingRates']) {
            $market = yield $this->market ($symbol);
            if (!$market['contract']) {
                throw new BadSymbol($this->id . ' fetchFundingRate() supports contract markets only');
            }
            $rates = yield $this->fetchFundingRates (array( $symbol ), $params);
            $rate = $this->safe_value($rates, $symbol);
            if ($rate === null) {
                throw new NullResponse($this->id . ' fetchFundingRate () returned no data for ' . $symbol);
            } else {
                return $rate;
            }
        } else {
            throw new NotSupported($this->id . ' fetchFundingRate () is not supported yet');
        }
    }

    public function fetch_mark_ohlcv($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array ()) {
        /**
         * fetches historical mark price candlestick data containing the open, high, low, and close price of a market
         * @param {str} $symbol unified $symbol of the market to fetch OHLCV data for
         * @param {str} $timeframe the length of time each candle represents
         * @param {int|null} $since timestamp in ms of the earliest candle to fetch
         * @param {int|null} $limit the maximum amount of candles to fetch
         * @param {dict} $params extra parameters specific to the exchange api endpoint
         * @return {[[int|float]]} A list of candles ordered as timestamp, open, high, low, close, null
         */
        if ($this->has['fetchMarkOHLCV']) {
            $request = array(
                'price' => 'mark',
            );
            return yield $this->fetch_ohlcv($symbol, $timeframe, $since, $limit, array_merge($request, $params));
        } else {
            throw new NotSupported($this->id . ' fetchMarkOHLCV () is not supported yet');
        }
    }

    public function fetch_index_ohlcv($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array ()) {
        /**
         * fetches historical index price candlestick data containing the open, high, low, and close price of a market
         * @param {str} $symbol unified $symbol of the market to fetch OHLCV data for
         * @param {str} $timeframe the length of time each candle represents
         * @param {int|null} $since timestamp in ms of the earliest candle to fetch
         * @param {int|null} $limit the maximum amount of candles to fetch
         * @param {dict} $params extra parameters specific to the exchange api endpoint
         * @return {[[int|float]]} A list of candles ordered as timestamp, open, high, low, close, null
         */
        if ($this->has['fetchIndexOHLCV']) {
            $request = array(
                'price' => 'index',
            );
            return yield $this->fetch_ohlcv($symbol, $timeframe, $since, $limit, array_merge($request, $params));
        } else {
            throw new NotSupported($this->id . ' fetchIndexOHLCV () is not supported yet');
        }
    }

    public function fetch_premium_index_ohlcv($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array ()) {
        /**
         * fetches historical premium index price candlestick data containing the open, high, low, and close price of a market
         * @param {str} $symbol unified $symbol of the market to fetch OHLCV data for
         * @param {str} $timeframe the length of time each candle represents
         * @param {int|null} $since timestamp in ms of the earliest candle to fetch
         * @param {int|null} $limit the maximum amount of candles to fetch
         * @param {dict} $params extra parameters specific to the exchange api endpoint
         * @return {[[int|float]]} A list of candles ordered as timestamp, open, high, low, close, null
         */
        if ($this->has['fetchPremiumIndexOHLCV']) {
            $request = array(
                'price' => 'premiumIndex',
            );
            return yield $this->fetch_ohlcv($symbol, $timeframe, $since, $limit, array_merge($request, $params));
        } else {
            throw new NotSupported($this->id . ' fetchPremiumIndexOHLCV () is not supported yet');
        }
    }
}
