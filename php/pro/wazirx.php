<?php

namespace ccxt\pro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\ExchangeError;
use ccxt\NotSupported;
use React\Async;

class wazirx extends \ccxt\async\wazirx {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'has' => array(
                'ws' => true,
                'watchBalance' => true,
                'watchTicker' => true,
                'watchTickers' => true,
                'watchTrades' => true,
                'watchMyTrades' => true,
                'watchOrders' => true,
                'watchOrderBook' => true,
                'watchOHLCV' => true,
            ),
            'urls' => array(
                'api' => array(
                    'ws' => 'wss://stream.wazirx.com/stream',
                ),
            ),
            'options' => array(
            ),
            'streaming' => array(
            ),
            'exceptions' => array(
            ),
            'api' => array(
                'private' => array(
                    'post' => array(
                        'create_auth_token' => 1,
                    ),
                ),
            ),
        ));
    }

    public function watch_balance($params = array ()) {
        return Async\async(function () use ($params) {
            /**
             * query for balance and get the amount of funds available for trading or funds locked in orders
             * @see https://docs.wazirx.com/#account-update
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {array} a ~@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure balance structure~
             */
            Async\await($this->load_markets());
            $token = Async\await($this->authenticate($params));
            $messageHash = 'balance';
            $url = $this->urls['api']['ws'];
            $subscribe = array(
                'event' => 'subscribe',
                'streams' => array( 'outboundAccountPosition' ),
                'auth_key' => $token,
            );
            $request = $this->deep_extend($subscribe, $params);
            return Async\await($this->watch($url, $messageHash, $request, $messageHash));
        }) ();
    }

    public function handle_balance(Client $client, $message) {
        //
        //     {
        //         "data":
        //         {
        //           "B" => array(
        //             array(
        //               "a":"wrx",
        //               "b":"2043856.426455209",
        //               "l":"3001318.98"
        //             }
        //           ),
        //           "E":1631683058909
        //         ),
        //         "stream":"outboundAccountPosition"
        //     }
        //
        $data = $this->safe_value($message, 'data', array());
        $balances = $this->safe_value($data, 'B', array());
        $timestamp = $this->safe_integer($data, 'E');
        $this->balance['info'] = $balances;
        $this->balance['timestamp'] = $timestamp;
        $this->balance['datetime'] = $this->iso8601($timestamp);
        for ($i = 0; $i < count($balances); $i++) {
            $balance = $balances[$i];
            $currencyId = $this->safe_string($balance, 'a');
            $code = $this->safe_currency_code($currencyId);
            $available = $this->safe_number($balance, 'b');
            $locked = $this->safe_number($balance, 'l');
            $account = $this->account();
            $account['free'] = $available;
            $account['used'] = $locked;
            $this->balance[$code] = $account;
        }
        $this->balance = $this->safe_balance($this->balance);
        $messageHash = 'balance';
        $client->resolve ($this->balance, $messageHash);
    }

    public function parse_ws_trade($trade, $market = null) {
        //
        // $trade
        //     {
        //         "E" => 1631681323000,  Event time
        //         "S" => "buy",          Side
        //         "a" => 26946138,       Buyer order ID
        //         "b" => 26946169,       Seller order ID
        //         "m" => true,           Is buyer maker?
        //         "p" => "7.0",          Price
        //         "q" => "15.0",         Quantity
        //         "s" => "btcinr",       Symbol
        //         "t" => 17376030        Trade ID
        //     }
        // ownTrade
        //     {
        //         "E" => 1631683058000,
        //         "S" => "ask",
        //         "U" => "inr",
        //         "a" => 114144050,
        //         "b" => 114144121,
        //         "f" => "0.2",
        //         "m" => true,
        //         "o" => 26946170,
        //         "p" => "5.0",
        //         "q" => "20.0",
        //         "s" => "btcinr",
        //         "t" => 17376032,
        //         "w" => "100.0"
        //     }
        //
        $timestamp = $this->safe_integer($trade, 'E');
        $marketId = $this->safe_string($trade, 's');
        $market = $this->safe_market($marketId, $market);
        $feeCost = $this->safe_string($trade, 'f');
        $feeCurrencyId = $this->safe_string($trade, 'U');
        $isMaker = $this->safe_value($trade, 'm') === true;
        $fee = null;
        if ($feeCost !== null) {
            $fee = array(
                'cost' => $feeCost,
                'currency' => $this->safe_currency_code($feeCurrencyId),
                'rate' => null,
            );
        }
        return $this->safe_trade(array(
            'id' => $this->safe_string($trade, 't'),
            'info' => $trade,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $market['symbol'],
            'order' => $this->safe_string_n($trade, array( 'o' )),
            'type' => null,
            'side' => $this->safe_string($trade, 'S'),
            'takerOrMaker' => $isMaker ? 'maker' : 'taker',
            'price' => $this->safe_string($trade, 'p'),
            'amount' => $this->safe_string($trade, 'q'),
            'cost' => null,
            'fee' => $fee,
        ), $market);
    }

    public function watch_ticker(string $symbol, $params = array ()) {
        return Async\async(function () use ($symbol, $params) {
            /**
             * watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
             * @see https://docs.wazirx.com/#all-$market-tickers-$stream
             * @param {string} $symbol unified $symbol of the $market to fetch the ticker for
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=ticker-structure ticker structure~
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $url = $this->urls['api']['ws'];
            $messageHash = 'ticker:' . $market['symbol'];
            $subscribeHash = 'tickers';
            $stream = '!' . 'ticker@arr';
            $subscribe = array(
                'event' => 'subscribe',
                'streams' => array( $stream ),
            );
            $request = $this->deep_extend($subscribe, $params);
            return Async\await($this->watch($url, $messageHash, $request, $subscribeHash));
        }) ();
    }

    public function watch_tickers(?array $symbols = null, $params = array ()) {
        return Async\async(function () use ($symbols, $params) {
            /**
             * watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for all markets of a specific list
             * @see https://docs.wazirx.com/#all-market-$tickers-$stream
             * @param {string[]} $symbols unified symbol of the market to fetch the ticker for
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=ticker-structure ticker structure~
             */
            Async\await($this->load_markets());
            $symbols = $this->market_symbols($symbols);
            $url = $this->urls['api']['ws'];
            $messageHash = 'tickers';
            $stream = '!' . 'ticker@arr';
            $subscribe = array(
                'event' => 'subscribe',
                'streams' => array( $stream ),
            );
            $request = $this->deep_extend($subscribe, $params);
            $tickers = Async\await($this->watch($url, $messageHash, $request, $messageHash));
            return $this->filter_by_array($tickers, 'symbol', $symbols, false);
        }) ();
    }

    public function handle_ticker(Client $client, $message) {
        //
        //     {
        //         "data":
        //         array(
        //           {
        //             "E":1631625534000,    // Event time
        //             "T":"SPOT",           // Type
        //             "U":"wrx",            // Quote unit
        //             "a":"0.0",            // Best sell price
        //             "b":"0.0",            // Best buy price
        //             "c":"5.0",            // Last price
        //             "h":"5.0",            // High price
        //             "l":"5.0",            // Low price
        //             "o":"5.0",            // Open price
        //             "q":"0.0",            // Quantity
        //             "s":"btcwrx",         // Symbol
        //             "u":"btc"             // Base unit
        //           }
        //         ),
        //         "stream":"!$ticker@arr"
        //     }
        //
        $data = $this->safe_value($message, 'data', array());
        for ($i = 0; $i < count($data); $i++) {
            $ticker = $data[$i];
            $parsedTicker = $this->parse_ws_ticker($ticker);
            $symbol = $parsedTicker['symbol'];
            $this->tickers[$symbol] = $parsedTicker;
            $messageHash = 'ticker:' . $symbol;
            $client->resolve ($parsedTicker, $messageHash);
        }
        $client->resolve ($this->tickers, 'tickers');
    }

    public function parse_ws_ticker($ticker, $market = null) {
        //
        //     {
        //         "E":1631625534000,    // Event time
        //         "T":"SPOT",           // Type
        //         "U":"wrx",            // Quote unit
        //         "a":"0.0",            // Best sell price
        //         "b":"0.0",            // Best buy price
        //         "c":"5.0",            // Last price
        //         "h":"5.0",            // High price
        //         "l":"5.0",            // Low price
        //         "o":"5.0",            // Open price
        //         "q":"0.0",            // Quantity
        //         "s":"btcwrx",         // Symbol
        //         "u":"btc"             // Base unit
        //     }
        //
        $marketId = $this->safe_string($ticker, 's');
        $timestamp = $this->safe_integer($ticker, 'E');
        return $this->safe_ticker(array(
            'symbol' => $this->safe_symbol($marketId, $market),
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => $this->safe_string($ticker, 'h'),
            'low' => $this->safe_string($ticker, 'l'),
            'bid' => $this->safe_number($ticker, 'b'),
            'bidVolume' => null,
            'ask' => $this->safe_number($ticker, 'a'),
            'askVolume' => null,
            'vwap' => null,
            'open' => $this->safe_string($ticker, 'o'),
            'close' => null,
            'last' => $this->safe_string($ticker, 'l'),
            'previousClose' => null,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => null,
            'quoteVolume' => $this->safe_string($ticker, 'q'),
            'info' => $ticker,
        ), $market);
    }

    public function watch_trades(string $symbol, ?int $since = null, ?int $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * get the list of most recent $trades for a particular $symbol
             * @param {string} $symbol unified $symbol of the $market to fetch $trades for
             * @param {int} [$since] timestamp in ms of the earliest trade to fetch
             * @param {int} [$limit] the maximum amount of $trades to fetch
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {array[]} a list of ~@link https://docs.ccxt.com/en/latest/manual.html?#public-$trades trade structures~
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $messageHash = $market['id'] . '@trades';
            $url = $this->urls['api']['ws'];
            $message = array(
                'event' => 'subscribe',
                'streams' => array( $messageHash ),
            );
            $request = array_merge($message, $params);
            $trades = Async\await($this->watch($url, $messageHash, $request, $messageHash));
            if ($this->newUpdates) {
                $limit = $trades->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($trades, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function handle_trades(Client $client, $message) {
        //
        //     {
        //         "data" => array(
        //             "trades" => [array(
        //                 "E" => 1631681323000,  Event time
        //                 "S" => "buy",          Side
        //                 "a" => 26946138,       Buyer order ID
        //                 "b" => 26946169,       Seller order ID
        //                 "m" => true,           Is buyer maker?
        //                 "p" => "7.0",          Price
        //                 "q" => "15.0",         Quantity
        //                 "s" => "btcinr",       Symbol
        //                 "t" => 17376030        Trade ID
        //             )]
        //         ),
        //         "stream" => "btcinr@$trades"
        //     }
        //
        $data = $this->safe_value($message, 'data', array());
        $rawTrades = $this->safe_value($data, 'trades', array());
        $messageHash = $this->safe_string($message, 'stream');
        $split = explode('@', $messageHash);
        $marketId = $this->safe_string($split, 0);
        $market = $this->safe_market($marketId);
        $symbol = $this->safe_symbol($marketId, $market);
        $trades = $this->safe_value($this->trades, $symbol);
        if ($trades === null) {
            $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
            $trades = new ArrayCache ($limit);
            $this->trades[$symbol] = $trades;
        }
        for ($i = 0; $i < count($rawTrades); $i++) {
            $parsedTrade = $this->parse_ws_trade($rawTrades[$i], $market);
            $trades->append ($parsedTrade);
        }
        $client->resolve ($trades, $messageHash);
    }

    public function watch_my_trades(?string $symbol = null, ?int $since = null, ?int $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * watch $trades by user
             * @see https://docs.wazirx.com/#trade-update
             * @param {string} $symbol unified $symbol of the $market to fetch $trades for
             * @param {int} [$since] timestamp in ms of the earliest trade to fetch
             * @param {int} [$limit] the maximum amount of $trades to fetch
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {array[]} a list of ~@link https://docs.ccxt.com/en/latest/manual.html?#public-$trades trade structures~
             */
            Async\await($this->load_markets());
            $token = Async\await($this->authenticate($params));
            if ($symbol !== null) {
                $market = $this->market($symbol);
                $symbol = $market['symbol'];
            }
            $url = $this->urls['api']['ws'];
            $messageHash = 'myTrades';
            $message = array(
                'event' => 'subscribe',
                'streams' => array( 'ownTrade' ),
                'auth_key' => $token,
            );
            $request = $this->deep_extend($message, $params);
            $trades = Async\await($this->watch($url, $messageHash, $request, $messageHash));
            if ($this->newUpdates) {
                $limit = $trades->getLimit ($symbol, $limit);
            }
            return $this->filter_by_symbol_since_limit($trades, $symbol, $since, $limit, true);
        }) ();
    }

    public function watch_ohlcv(string $symbol, $timeframe = '1m', ?int $since = null, ?int $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $timeframe, $since, $limit, $params) {
            /**
             * watches historical candlestick data containing the open, high, low, and close price, and the volume of a $market
             * @param {string} $symbol unified $symbol of the $market to fetch OHLCV data for
             * @param {string} $timeframe the length of time each candle represents
             * @param {int} [$since] timestamp in ms of the earliest candle to fetch
             * @param {int} [$limit] the maximum amount of candles to fetch
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {int[][]} A list of candles ordered, open, high, low, close, volume
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $url = $this->urls['api']['ws'];
            $messageHash = 'ohlcv:' . $symbol . ':' . $timeframe;
            $stream = $market['id'] . '@kline_' . $timeframe;
            $message = array(
                'event' => 'subscribe',
                'streams' => array( $stream ),
            );
            $request = $this->deep_extend($message, $params);
            $ohlcv = Async\await($this->watch($url, $messageHash, $request, $messageHash));
            if ($this->newUpdates) {
                $limit = $ohlcv->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($ohlcv, $since, $limit, 0, true);
        }) ();
    }

    public function handle_ohlcv(Client $client, $message) {
        //
        //     {
        //         "data" => array(
        //           "E":1631683058904,      Event time
        //           "s" => "btcinr",          Symbol
        //           "t" => 1638747660000,     Kline start time
        //           "T" => 1638747719999,     Kline close time
        //           "i" => "1m",              Interval
        //           "o" => "0.0010",          Open price
        //           "c" => "0.0020",          Close price
        //           "h" => "0.0025",          High price
        //           "l" => "0.0015",          Low price
        //           "v" => "1000",            Base asset volume
        //         ),
        //         "stream" => "btcinr@kline_1m"
        //     }
        //
        $data = $this->safe_value($message, 'data', array());
        $marketId = $this->safe_string($data, 's');
        $market = $this->safe_market($marketId);
        $symbol = $this->safe_symbol($marketId, $market);
        $timeframe = $this->safe_string($data, 'i');
        $this->ohlcvs[$symbol] = $this->safe_value($this->ohlcvs, $symbol, array());
        $stored = $this->safe_value($this->ohlcvs[$symbol], $timeframe);
        if ($stored === null) {
            $limit = $this->safe_integer($this->options, 'OHLCVLimit', 1000);
            $stored = new ArrayCacheByTimestamp ($limit);
            $this->ohlcvs[$symbol][$timeframe] = $stored;
        }
        $parsed = $this->parse_ws_ohlcv($data, $market);
        $stored->append ($parsed);
        $messageHash = 'ohlcv:' . $symbol . ':' . $timeframe;
        $client->resolve ($stored, $messageHash);
    }

    public function parse_ws_ohlcv($ohlcv, $market = null) {
        //
        //    {
        //        "E":1631683058904,      Event time
        //        "s" => "btcinr",          Symbol
        //        "t" => 1638747660000,     Kline start time
        //        "T" => 1638747719999,     Kline close time
        //        "i" => "1m",              Interval
        //        "o" => "0.0010",          Open price
        //        "c" => "0.0020",          Close price
        //        "h" => "0.0025",          High price
        //        "l" => "0.0015",          Low price
        //        "v" => "1000",            Base asset volume
        //    }
        //
        return array(
            $this->safe_integer($ohlcv, 't'),
            $this->safe_number($ohlcv, 'o'),
            $this->safe_number($ohlcv, 'c'),
            $this->safe_number($ohlcv, 'h'),
            $this->safe_number($ohlcv, 'l'),
            $this->safe_number($ohlcv, 'v'),
        );
    }

    public function watch_order_book(string $symbol, ?int $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $limit, $params) {
            /**
             * watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
             * @see https://docs.wazirx.com/#depth-$stream
             * @param {string} $symbol unified $symbol of the $market to fetch the order book for
             * @param {int} [$limit] the maximum amount of order book entries to return
             * @param {array} [$params] extra parameters specific to the wazirx api endpoint
             * @return {array} A dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by $market symbols
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $url = $this->urls['api']['ws'];
            $messageHash = 'orderbook:' . $symbol;
            $stream = $market['id'] . '@depth';
            $subscribe = array(
                'event' => 'subscribe',
                'streams' => array( $stream ),
            );
            $request = $this->deep_extend($subscribe, $params);
            $orderbook = Async\await($this->watch($url, $messageHash, $request, $messageHash));
            return $orderbook->limit ();
        }) ();
    }

    public function handle_delta($bookside, $delta) {
        $bidAsk = $this->parse_bid_ask($delta, 0, 1);
        $bookside->storeArray ($bidAsk);
    }

    public function handle_deltas($bookside, $deltas) {
        for ($i = 0; $i < count($deltas); $i++) {
            $this->handle_delta($bookside, $deltas[$i]);
        }
    }

    public function handle_order_book(Client $client, $message) {
        //
        //     {
        //         "data" => array(
        //             "E" => 1659475095000,
        //             "a" => [
        //                 ["23051.0", "1.30141"],
        //             ],
        //             "b" => [
        //                 ["22910.0", "1.30944"],
        //             ],
        //             "s" => "btcusdt"
        //         ),
        //         "stream" => "btcusdt@depth"
        //     }
        //
        $data = $this->safe_value($message, 'data', array());
        $timestamp = $this->safe_integer($data, 'E');
        $marketId = $this->safe_string($data, 's');
        $market = $this->safe_market($marketId);
        $symbol = $market['symbol'];
        $messageHash = 'orderbook:' . $symbol;
        $currentOrderBook = $this->safe_value($this->orderbooks, $symbol);
        if ($currentOrderBook === null) {
            $snapshot = $this->parse_order_book($data, $symbol, $timestamp, 'b', 'a');
            $orderBook = $this->order_book($snapshot);
            $this->orderbooks[$symbol] = $orderBook;
        } else {
            $asks = $this->safe_value($data, 'a', array());
            $bids = $this->safe_value($data, 'b', array());
            $this->handle_deltas($currentOrderBook['asks'], $asks);
            $this->handle_deltas($currentOrderBook['bids'], $bids);
            $currentOrderBook['nonce'] = $timestamp;
            $currentOrderBook['timestamp'] = $timestamp;
            $currentOrderBook['datetime'] = $this->iso8601($timestamp);
            $this->orderbooks[$symbol] = $currentOrderBook;
        }
        $client->resolve ($this->orderbooks[$symbol], $messageHash);
    }

    public function watch_orders(?string $symbol = null, ?int $since = null, ?int $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            Async\await($this->load_markets());
            if ($symbol !== null) {
                $market = $this->market($symbol);
                $symbol = $market['symbol'];
            }
            $token = Async\await($this->authenticate($params));
            $messageHash = 'orders';
            $message = array(
                'event' => 'subscribe',
                'streams' => array( 'orderUpdate' ),
                'auth_key' => $token,
            );
            $url = $this->urls['api']['ws'];
            $request = $this->deep_extend($message, $params);
            $orders = Async\await($this->watch($url, $messageHash, $request, $messageHash, $request));
            if ($this->newUpdates) {
                $limit = $orders->getLimit ($symbol, $limit);
            }
            return $this->filter_by_symbol_since_limit($orders, $symbol, $since, $limit, true);
        }) ();
    }

    public function handle_order(Client $client, $message) {
        //
        //     {
        //         "data" => array(
        //             "E" => 1631683058904,
        //             "O" => 1631683058000,
        //             "S" => "ask",
        //             "V" => "70.0",
        //             "X" => "wait",
        //             "i" => 26946170,
        //             "m" => true,
        //             "o" => "sell",
        //             "p" => "5.0",
        //             "q" => "70.0",
        //             "s" => "wrxinr",
        //             "v" => "0.0"
        //         ),
        //         "stream" => "orderUpdate"
        //     }
        //
        $order = $this->safe_value($message, 'data', array());
        $parsedOrder = $this->parse_ws_order($order);
        if ($this->orders === null) {
            $limit = $this->safe_integer($this->options, 'ordersLimit', 1000);
            $this->orders = new ArrayCacheBySymbolById ($limit);
        }
        $this->orders.append ($parsedOrder);
        $messageHash = 'orders';
        $client->resolve ($this->orders, $messageHash);
        $messageHash .= ':' . $parsedOrder['symbol'];
        $client->resolve ($this->orders, $messageHash);
    }

    public function parse_ws_order($order, $market = null) {
        //
        //     {
        //         "E" => 1631683058904,
        //         "O" => 1631683058000,
        //         "S" => "ask",
        //         "V" => "70.0",
        //         "X" => "wait",
        //         "i" => 26946170,
        //         "m" => true,
        //         "o" => "sell",
        //         "p" => "5.0",
        //         "q" => "70.0",
        //         "s" => "wrxinr",
        //         "v" => "0.0"
        //     }
        //
        $timestamp = $this->safe_integer($order, 'O');
        $marketId = $this->safe_string($order, 's');
        $status = $this->safe_string($order, 'X');
        $market = $this->safe_market($marketId);
        return $this->safe_order(array(
            'info' => $order,
            'id' => $this->safe_string($order, 'i'),
            'clientOrderId' => $this->safe_string($order, 'c'),
            'datetime' => $this->iso8601($timestamp),
            'timestamp' => $timestamp,
            'lastTradeTimestamp' => null,
            'symbol' => $market['symbol'],
            'type' => $this->safe_value($order, 'm') ? 'limit' : 'market',
            'timeInForce' => null,
            'postOnly' => null,
            'side' => $this->safe_string($order, 'o'),
            'price' => $this->safe_string($order, 'p'),
            'stopPrice' => null,
            'triggerPrice' => null,
            'amount' => $this->safe_string($order, 'V'),
            'filled' => null,
            'remaining' => $this->safe_string($order, 'q'),
            'cost' => null,
            'average' => $this->safe_string($order, 'v'),
            'status' => $this->parse_order_status($status),
            'fee' => null,
            'trades' => null,
        ), $market);
    }

    public function handle_my_trades(Client $client, $message) {
        //
        //     {
        //         "data" => array(
        //             "E" => 1631683058000,
        //             "S" => "ask",
        //             "U" => "usdt",
        //             "a" => 114144050,
        //             "b" => 114144121,
        //             "f" => "0.2",
        //             "ga" => '0.0',
        //             "gc" => 'usdt',
        //             "m" => true,
        //             "o" => 26946170,
        //             "p" => "5.0",
        //             "q" => "20.0",
        //             "s" => "btcusdt",
        //             "t" => 17376032,
        //             "w" => "100.0"
        //         ),
        //         "stream" => "ownTrade"
        //     }
        //
        $trade = $this->safe_value($message, 'data', array());
        $messageHash = 'myTrades';
        $myTrades = null;
        if ($this->myTrades === null) {
            $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
            $myTrades = new ArrayCacheBySymbolById ($limit);
            $this->myTrades = $myTrades;
        } else {
            $myTrades = $this->myTrades;
        }
        $parsedTrade = $this->parse_ws_trade($trade);
        $myTrades->append ($parsedTrade);
        $client->resolve ($myTrades, $messageHash);
    }

    public function handle_connected(Client $client, $message) {
        //
        //     {
        //         data => array(
        //             timeout_duration => 1800
        //         ),
        //         event => 'connected'
        //     }
        //
        return $message;
    }

    public function handle_subscribed(Client $client, $message) {
        //
        //     {
        //         data => array(
        //             streams => ['!ticker@arr']
        //         ),
        //         event => 'subscribed',
        //         id => 0
        //     }
        //
        return $message;
    }

    public function handle_error(Client $client, $message) {
        //
        //     {
        //         "data" => array(
        //             "code" => 400,
        //             "message" => "Invalid request => streams must be an array"
        //         ),
        //         "event" => "error",
        //         "id" => 0
        //     }
        //
        //     {
        //         $message => 'HeartBeat $message not received, closing the connection',
        //         status => 'error'
        //     }
        //
        throw new ExchangeError($this->id . ' ' . $this->json($message));
    }

    public function handle_message(Client $client, $message) {
        $status = $this->safe_string($message, 'status');
        if ($status === 'error') {
            return $this->handle_error($client, $message);
        }
        $event = $this->safe_string($message, 'event');
        $eventHandlers = array(
            'error' => array($this, 'handle_error'),
            'connected' => array($this, 'handle_connected'),
            'subscribed' => array($this, 'handle_subscribed'),
        );
        $eventHandler = $this->safe_value($eventHandlers, $event);
        if ($eventHandler !== null) {
            return $eventHandler($client, $message);
        }
        $stream = $this->safe_string($message, 'stream', '');
        $streamHandlers = array(
            'ticker@arr' => array($this, 'handle_ticker'),
            '@depth' => array($this, 'handle_order_book'),
            '@kline' => array($this, 'handle_ohlcv'),
            '@trades' => array($this, 'handle_trades'),
            'outboundAccountPosition' => array($this, 'handle_balance'),
            'orderUpdate' => array($this, 'handle_order'),
            'ownTrade' => array($this, 'handle_my_trades'),
        );
        $streams = is_array($streamHandlers) ? array_keys($streamHandlers) : array();
        for ($i = 0; $i < count($streams); $i++) {
            if ($this->in_array($streams[$i], $stream)) {
                $handler = $streamHandlers[$streams[$i]];
                return $handler($client, $message);
            }
        }
        throw new NotSupported($this->id . ' this $message type is not supported yet. Message => ' . $this->json($message));
    }

    public function authenticate($params = array ()) {
        return Async\async(function () use ($params) {
            $url = $this->urls['api']['ws'];
            $client = $this->client($url);
            $messageHash = 'authenticated';
            $now = $this->milliseconds();
            $subscription = $this->safe_value($client->subscriptions, $messageHash);
            $expires = $this->safe_integer($subscription, 'expires');
            if ($subscription === null || $now > $expires) {
                $subscription = Async\await($this->privatePostCreateAuthToken ());
                $subscription['expires'] = $now . $this->safe_integer($subscription, 'timeout_duration') * 1000;
                //
                //     {
                //         "auth_key" => "Xx***dM",
                //         "timeout_duration" => 900
                //     }
                //
                $client->subscriptions[$messageHash] = $subscription;
            }
            return $this->safe_string($subscription, 'auth_key');
        }) ();
    }
}
