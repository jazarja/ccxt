<?php

namespace ccxt;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\abstract\coincheck as Exchange;

class coincheck extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'id' => 'coincheck',
            'name' => 'coincheck',
            'countries' => array( 'JP', 'ID' ),
            'rateLimit' => 1500,
            'has' => array(
                'CORS' => null,
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'addMargin' => false,
                'cancelOrder' => true,
                'createOrder' => true,
                'createReduceOnlyOrder' => false,
                'fetchBalance' => true,
                'fetchBorrowRate' => false,
                'fetchBorrowRateHistories' => false,
                'fetchBorrowRateHistory' => false,
                'fetchBorrowRates' => false,
                'fetchBorrowRatesPerSymbol' => false,
                'fetchDeposits' => true,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchLeverage' => false,
                'fetchMarginMode' => false,
                'fetchMarkOHLCV' => false,
                'fetchMyTrades' => true,
                'fetchOpenInterestHistory' => false,
                'fetchOpenOrders' => true,
                'fetchOrderBook' => true,
                'fetchPosition' => false,
                'fetchPositionMode' => false,
                'fetchPositions' => false,
                'fetchPositionsRisk' => false,
                'fetchPremiumIndexOHLCV' => false,
                'fetchTicker' => true,
                'fetchTrades' => true,
                'fetchTradingFee' => false,
                'fetchTradingFees' => true,
                'fetchWithdrawals' => true,
                'reduceMargin' => false,
                'setLeverage' => false,
                'setMarginMode' => false,
                'setPositionMode' => false,
            ),
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/51840849/87182088-1d6d6380-c2ec-11ea-9c64-8ab9f9b289f5.jpg',
                'api' => array(
                    'rest' => 'https://coincheck.com/api',
                ),
                'www' => 'https://coincheck.com',
                'doc' => 'https://coincheck.com/documents/exchange/api',
                'fees' => array(
                    'https://coincheck.com/exchange/fee',
                    'https://coincheck.com/info/fee',
                ),
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'exchange/orders/rate',
                        'order_books',
                        'rate/{pair}',
                        'ticker',
                        'trades',
                    ),
                ),
                'private' => array(
                    'get' => array(
                        'accounts',
                        'accounts/balance',
                        'accounts/leverage_balance',
                        'bank_accounts',
                        'deposit_money',
                        'exchange/orders/opens',
                        'exchange/orders/transactions',
                        'exchange/orders/transactions_pagination',
                        'exchange/leverage/positions',
                        'lending/borrows/matches',
                        'send_money',
                        'withdraws',
                    ),
                    'post' => array(
                        'bank_accounts',
                        'deposit_money/{id}/fast',
                        'exchange/orders',
                        'exchange/transfers/to_leverage',
                        'exchange/transfers/from_leverage',
                        'lending/borrows',
                        'lending/borrows/{id}/repay',
                        'send_money',
                        'withdraws',
                    ),
                    'delete' => array(
                        'bank_accounts/{id}',
                        'exchange/orders/{id}',
                        'withdraws/{id}',
                    ),
                ),
            ),
            'markets' => array(
                'BTC/JPY' => $this->safe_market_structure(array( 'id' => 'btc_jpy', 'symbol' => 'BTC/JPY', 'base' => 'BTC', 'quote' => 'JPY', 'baseId' => 'btc', 'quoteId' => 'jpy', 'type' => 'spot', 'spot' => true )), // the only real pair
                // 'ETH/JPY' => array( 'id' => 'eth_jpy', 'symbol' => 'ETH/JPY', 'base' => 'ETH', 'quote' => 'JPY', 'baseId' => 'eth', 'quoteId' => 'jpy' ),
                'ETC/JPY' => $this->safe_market_structure(array( 'id' => 'etc_jpy', 'symbol' => 'ETC/JPY', 'base' => 'ETC', 'quote' => 'JPY', 'baseId' => 'etc', 'quoteId' => 'jpy', 'type' => 'spot', 'spot' => true )),
                // 'DAO/JPY' => array( 'id' => 'dao_jpy', 'symbol' => 'DAO/JPY', 'base' => 'DAO', 'quote' => 'JPY', 'baseId' => 'dao', 'quoteId' => 'jpy' ),
                // 'LSK/JPY' => array( 'id' => 'lsk_jpy', 'symbol' => 'LSK/JPY', 'base' => 'LSK', 'quote' => 'JPY', 'baseId' => 'lsk', 'quoteId' => 'jpy' ),
                'FCT/JPY' => $this->safe_market_structure(array( 'id' => 'fct_jpy', 'symbol' => 'FCT/JPY', 'base' => 'FCT', 'quote' => 'JPY', 'baseId' => 'fct', 'quoteId' => 'jpy', 'type' => 'spot', 'spot' => true )),
                'MONA/JPY' => $this->safe_market_structure(array( 'id' => 'mona_jpy', 'symbol' => 'MONA/JPY', 'base' => 'MONA', 'quote' => 'JPY', 'baseId' => 'mona', 'quoteId' => 'jpy', 'type' => 'spot', 'spot' => true )),
                // 'XMR/JPY' => array( 'id' => 'xmr_jpy', 'symbol' => 'XMR/JPY', 'base' => 'XMR', 'quote' => 'JPY', 'baseId' => 'xmr', 'quoteId' => 'jpy' ),
                // 'REP/JPY' => array( 'id' => 'rep_jpy', 'symbol' => 'REP/JPY', 'base' => 'REP', 'quote' => 'JPY', 'baseId' => 'rep', 'quoteId' => 'jpy' ),
                // 'XRP/JPY' => array( 'id' => 'xrp_jpy', 'symbol' => 'XRP/JPY', 'base' => 'XRP', 'quote' => 'JPY', 'baseId' => 'xrp', 'quoteId' => 'jpy' ),
                // 'ZEC/JPY' => array( 'id' => 'zec_jpy', 'symbol' => 'ZEC/JPY', 'base' => 'ZEC', 'quote' => 'JPY', 'baseId' => 'zec', 'quoteId' => 'jpy' ),
                // 'XEM/JPY' => array( 'id' => 'xem_jpy', 'symbol' => 'XEM/JPY', 'base' => 'XEM', 'quote' => 'JPY', 'baseId' => 'xem', 'quoteId' => 'jpy' ),
                // 'LTC/JPY' => array( 'id' => 'ltc_jpy', 'symbol' => 'LTC/JPY', 'base' => 'LTC', 'quote' => 'JPY', 'baseId' => 'ltc', 'quoteId' => 'jpy' ),
                // 'DASH/JPY' => array( 'id' => 'dash_jpy', 'symbol' => 'DASH/JPY', 'base' => 'DASH', 'quote' => 'JPY', 'baseId' => 'dash', 'quoteId' => 'jpy' ),
                // 'ETH/BTC' => array( 'id' => 'eth_btc', 'symbol' => 'ETH/BTC', 'base' => 'ETH', 'quote' => 'BTC', 'baseId' => 'eth', 'quoteId' => 'btc' ),
                'ETC/BTC' => $this->safe_market_structure(array( 'id' => 'etc_btc', 'symbol' => 'ETC/BTC', 'base' => 'ETC', 'quote' => 'BTC', 'baseId' => 'etc', 'quoteId' => 'btc', 'type' => 'spot', 'spot' => true )),
                // 'LSK/BTC' => array( 'id' => 'lsk_btc', 'symbol' => 'LSK/BTC', 'base' => 'LSK', 'quote' => 'BTC', 'baseId' => 'lsk', 'quoteId' => 'btc' ),
                // 'FCT/BTC' => array( 'id' => 'fct_btc', 'symbol' => 'FCT/BTC', 'base' => 'FCT', 'quote' => 'BTC', 'baseId' => 'fct', 'quoteId' => 'btc' ),
                // 'XMR/BTC' => array( 'id' => 'xmr_btc', 'symbol' => 'XMR/BTC', 'base' => 'XMR', 'quote' => 'BTC', 'baseId' => 'xmr', 'quoteId' => 'btc' ),
                // 'REP/BTC' => array( 'id' => 'rep_btc', 'symbol' => 'REP/BTC', 'base' => 'REP', 'quote' => 'BTC', 'baseId' => 'rep', 'quoteId' => 'btc' ),
                // 'XRP/BTC' => array( 'id' => 'xrp_btc', 'symbol' => 'XRP/BTC', 'base' => 'XRP', 'quote' => 'BTC', 'baseId' => 'xrp', 'quoteId' => 'btc' ),
                // 'ZEC/BTC' => array( 'id' => 'zec_btc', 'symbol' => 'ZEC/BTC', 'base' => 'ZEC', 'quote' => 'BTC', 'baseId' => 'zec', 'quoteId' => 'btc' ),
                // 'XEM/BTC' => array( 'id' => 'xem_btc', 'symbol' => 'XEM/BTC', 'base' => 'XEM', 'quote' => 'BTC', 'baseId' => 'xem', 'quoteId' => 'btc' ),
                // 'LTC/BTC' => array( 'id' => 'ltc_btc', 'symbol' => 'LTC/BTC', 'base' => 'LTC', 'quote' => 'BTC', 'baseId' => 'ltc', 'quoteId' => 'btc' ),
                // 'DASH/BTC' => array( 'id' => 'dash_btc', 'symbol' => 'DASH/BTC', 'base' => 'DASH', 'quote' => 'BTC', 'baseId' => 'dash', 'quoteId' => 'btc' ),
            ),
            'fees' => array(
                'trading' => array(
                    'tierBased' => false,
                    'percentage' => true,
                    'maker' => $this->parse_number('0'),
                    'taker' => $this->parse_number('0'),
                ),
            ),
            'precisionMode' => TICK_SIZE,
            'exceptions' => array(
                'exact' => array(
                    'disabled API Key' => '\\ccxt\\AuthenticationError', // array("success":false,"error":"disabled API Key")'
                    'invalid authentication' => '\\ccxt\\AuthenticationError', // array("success":false,"error":"invalid authentication")
                ),
                'broad' => array(),
            ),
        ));
    }

    public function parse_balance($response): array {
        $result = array( 'info' => $response );
        $codes = is_array($this->currencies) ? array_keys($this->currencies) : array();
        for ($i = 0; $i < count($codes); $i++) {
            $code = $codes[$i];
            $currency = $this->currency($code);
            $currencyId = $currency['id'];
            if (is_array($response) && array_key_exists($currencyId, $response)) {
                $account = $this->account();
                $reserved = $currencyId . '_reserved';
                $account['free'] = $this->safe_string($response, $currencyId);
                $account['used'] = $this->safe_string($response, $reserved);
                $result[$code] = $account;
            }
        }
        return $this->safe_balance($result);
    }

    public function fetch_balance($params = array ()): array {
        /**
         * query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array} a {@link https://github.com/ccxt/ccxt/wiki/Manual#balance-structure balance structure}
         */
        $this->load_markets();
        $response = $this->privateGetAccountsBalance ($params);
        return $this->parse_balance($response);
    }

    public function fetch_open_orders(?string $symbol = null, ?int $since = null, ?int $limit = null, $params = array ()): array {
        /**
         * fetch all unfilled currently open orders
         * @param {string} $symbol unified $market $symbol
         * @param {int} [$since] the earliest time in ms to fetch open orders for
         * @param {int} [$limit] the maximum number of  open orders structures to retrieve
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {Order[]} a list of {@link https://github.com/ccxt/ccxt/wiki/Manual#order-structure order structures}
         */
        $this->load_markets();
        // Only BTC/JPY is meaningful
        $market = null;
        if ($symbol !== null) {
            $market = $this->market($symbol);
        }
        $response = $this->privateGetExchangeOrdersOpens ($params);
        $rawOrders = $this->safe_value($response, 'orders', array());
        $parsedOrders = $this->parse_orders($rawOrders, $market, $since, $limit);
        $result = array();
        for ($i = 0; $i < count($parsedOrders); $i++) {
            $result[] = array_merge($parsedOrders[$i], array( 'status' => 'open' ));
        }
        return $result;
    }

    public function parse_order($order, $market = null): array {
        //
        // fetchOpenOrders
        //
        //     {                        $id =>  202835,
        //                      "order_type" => "buy",
        //                            "rate" =>  26890,
        //                            "pair" => "btc_jpy",
        //                  "pending_amount" => "0.5527",
        //       "pending_market_buy_amount" =>  null,
        //                  "stop_loss_rate" =>  null,
        //                      "created_at" => "2015-01-10T05:55:38.000Z" }
        //
        // todo => add formats for fetchOrder, fetchClosedOrders here
        //
        $id = $this->safe_string($order, 'id');
        $side = $this->safe_string($order, 'order_type');
        $timestamp = $this->parse8601($this->safe_string($order, 'created_at'));
        $amount = $this->safe_string($order, 'pending_amount');
        $remaining = $this->safe_string($order, 'pending_amount');
        $price = $this->safe_string($order, 'rate');
        $status = null;
        $marketId = $this->safe_string($order, 'pair');
        $symbol = $this->safe_symbol($marketId, $market, '_');
        return $this->safe_order(array(
            'id' => $id,
            'clientOrderId' => null,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'lastTradeTimestamp' => null,
            'amount' => $amount,
            'remaining' => $remaining,
            'filled' => null,
            'side' => $side,
            'type' => null,
            'timeInForce' => null,
            'postOnly' => null,
            'status' => $status,
            'symbol' => $symbol,
            'price' => $price,
            'stopPrice' => null,
            'triggerPrice' => null,
            'cost' => null,
            'fee' => null,
            'info' => $order,
            'average' => null,
            'trades' => null,
        ), $market);
    }

    public function fetch_order_book(string $symbol, ?int $limit = null, $params = array ()): array {
        /**
         * fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {string} $symbol unified $symbol of the $market to fetch the order book for
         * @param {int} [$limit] the maximum amount of order book entries to return
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array} A dictionary of {@link https://github.com/ccxt/ccxt/wiki/Manual#order-book-structure order book structures} indexed by $market symbols
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'pair' => $market['id'],
        );
        $response = $this->publicGetOrderBooks (array_merge($request, $params));
        return $this->parse_order_book($response, $market['symbol']);
    }

    public function parse_ticker($ticker, $market = null): array {
        //
        // {
        //     "last":4192632.0,
        //     "bid":4192496.0,
        //     "ask":4193749.0,
        //     "high":4332000.0,
        //     "low":4101047.0,
        //     "volume":2313.43191762,
        //     "timestamp":1643374115
        // }
        //
        $symbol = $this->safe_symbol(null, $market);
        $timestamp = $this->safe_timestamp($ticker, 'timestamp');
        $last = $this->safe_string($ticker, 'last');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => $this->safe_string($ticker, 'high'),
            'low' => $this->safe_string($ticker, 'low'),
            'bid' => $this->safe_string($ticker, 'bid'),
            'bidVolume' => null,
            'ask' => $this->safe_string($ticker, 'ask'),
            'askVolume' => null,
            'vwap' => null,
            'open' => null,
            'close' => $last,
            'last' => $last,
            'previousClose' => null,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => $this->safe_string($ticker, 'volume'),
            'quoteVolume' => null,
            'info' => $ticker,
        ), $market);
    }

    public function fetch_ticker(string $symbol, $params = array ()): array {
        /**
         * fetches a price $ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
         * @param {string} $symbol unified $symbol of the $market to fetch the $ticker for
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array} a {@link https://github.com/ccxt/ccxt/wiki/Manual#$ticker-structure $ticker structure}
         */
        if ($symbol !== 'BTC/JPY') {
            throw new BadSymbol($this->id . ' fetchTicker() supports BTC/JPY only');
        }
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'pair' => $market['id'],
        );
        $ticker = $this->publicGetTicker (array_merge($request, $params));
        //
        // {
        //     "last":4192632.0,
        //     "bid":4192496.0,
        //     "ask":4193749.0,
        //     "high":4332000.0,
        //     "low":4101047.0,
        //     "volume":2313.43191762,
        //     "timestamp":1643374115
        // }
        //
        return $this->parse_ticker($ticker, $market);
    }

    public function parse_trade($trade, $market = null): array {
        //
        // fetchTrades (public)
        //
        //      {
        //          "id" => "206849494",
        //          "amount" => "0.01",
        //          "rate" => "5598346.0",
        //          "pair" => "btc_jpy",
        //          "order_type" => "sell",
        //          "created_at" => "2021-12-08T14:10:33.000Z"
        //      }
        //
        // fetchMyTrades (private) - example from docs
        //
        //      {
        //          "id" => 38,
        //          "order_id" => 49,
        //          "created_at" => "2015-11-18T07:02:21.000Z",
        //          "funds" => array(
        //              "btc" => "0.1",
        //              "jpy" => "-4096.135"
        //                  ),
        //           "pair" => "btc_jpy",
        //           "rate" => "40900.0",
        //           "fee_currency" => "JPY",
        //           "fee" => "6.135",
        //           "liquidity" => "T",
        //           "side" => "buy"
        //      }
        //
        $timestamp = $this->parse8601($this->safe_string($trade, 'created_at'));
        $id = $this->safe_string($trade, 'id');
        $priceString = $this->safe_string($trade, 'rate');
        $marketId = $this->safe_string($trade, 'pair');
        $market = $this->safe_market($marketId, $market, '_');
        $baseId = $market['baseId'];
        $quoteId = $market['quoteId'];
        $symbol = $market['symbol'];
        $takerOrMaker = null;
        $amountString = null;
        $costString = null;
        $side = null;
        $fee = null;
        $orderId = null;
        if (is_array($trade) && array_key_exists('liquidity', $trade)) {
            if ($this->safe_string($trade, 'liquidity') === 'T') {
                $takerOrMaker = 'taker';
            } elseif ($this->safe_string($trade, 'liquidity') === 'M') {
                $takerOrMaker = 'maker';
            }
            $funds = $this->safe_value($trade, 'funds', array());
            $amountString = $this->safe_string($funds, $baseId);
            $costString = $this->safe_string($funds, $quoteId);
            $fee = array(
                'currency' => $this->safe_string($trade, 'fee_currency'),
                'cost' => $this->safe_string($trade, 'fee'),
            );
            $side = $this->safe_string($trade, 'side');
            $orderId = $this->safe_string($trade, 'order_id');
        } else {
            $amountString = $this->safe_string($trade, 'amount');
            $side = $this->safe_string($trade, 'order_type');
        }
        return $this->safe_trade(array(
            'id' => $id,
            'info' => $trade,
            'datetime' => $this->iso8601($timestamp),
            'timestamp' => $timestamp,
            'symbol' => $symbol,
            'type' => null,
            'side' => $side,
            'order' => $orderId,
            'takerOrMaker' => $takerOrMaker,
            'price' => $priceString,
            'amount' => $amountString,
            'cost' => $costString,
            'fee' => $fee,
        ), $market);
    }

    public function fetch_my_trades(?string $symbol = null, ?int $since = null, ?int $limit = null, $params = array ()) {
        /**
         * fetch all trades made by the user
         * @param {string} $symbol unified $market $symbol
         * @param {int} [$since] the earliest time in ms to fetch trades for
         * @param {int} [$limit] the maximum number of trades structures to retrieve
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {Trade[]} a list of {@link https://github.com/ccxt/ccxt/wiki/Manual#trade-structure trade structures}
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array();
        if ($limit !== null) {
            $request['limit'] = $limit;
        }
        $response = $this->privateGetExchangeOrdersTransactionsPagination (array_merge($request, $params));
        //
        //      {
        //          "success" => true,
        //          "data" => array(
        //                      array(
        //                          "id" => 38,
        //                          "order_id" => 49,
        //                          "created_at" => "2015-11-18T07:02:21.000Z",
        //                          "funds" => array(
        //                              "btc" => "0.1",
        //                              "jpy" => "-4096.135"
        //                                  ),
        //                          "pair" => "btc_jpy",
        //                          "rate" => "40900.0",
        //                          "fee_currency" => "JPY",
        //                          "fee" => "6.135",
        //                          "liquidity" => "T",
        //                          "side" => "buy"
        //                       ),
        //                  )
        //      }
        //
        $transactions = $this->safe_value($response, 'data', array());
        return $this->parse_trades($transactions, $market, $since, $limit);
    }

    public function fetch_trades(string $symbol, ?int $since = null, ?int $limit = null, $params = array ()): array {
        /**
         * get the list of most recent trades for a particular $symbol
         * @param {string} $symbol unified $symbol of the $market to fetch trades for
         * @param {int} [$since] timestamp in ms of the earliest trade to fetch
         * @param {int} [$limit] the maximum amount of trades to fetch
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {Trade[]} a list of {@link https://github.com/ccxt/ccxt/wiki/Manual#public-trades trade structures}
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'pair' => $market['id'],
        );
        if ($limit !== null) {
            $request['limit'] = $limit;
        }
        $response = $this->publicGetTrades (array_merge($request, $params));
        //
        //      {
        //          "id" => "206849494",
        //          "amount" => "0.01",
        //          "rate" => "5598346.0",
        //          "pair" => "btc_jpy",
        //          "order_type" => "sell",
        //          "created_at" => "2021-12-08T14:10:33.000Z"
        //      }
        //
        $data = $this->safe_value($response, 'data', array());
        return $this->parse_trades($data, $market, $since, $limit);
    }

    public function fetch_trading_fees($params = array ()) {
        /**
         * fetch the trading $fees for multiple markets
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array} a dictionary of {@link https://github.com/ccxt/ccxt/wiki/Manual#$fee-structure $fee structures} indexed by $market symbols
         */
        $this->load_markets();
        $response = $this->privateGetAccounts ($params);
        //
        //     {
        //         "success" => true,
        //         "id" => "7487995",
        //         "email" => "some@email.com",
        //         "identity_status" => "identity_pending",
        //         "bitcoin_address" => null,
        //         "lending_leverage" => "4",
        //         "taker_fee" => "0.0",
        //         "maker_fee" => "0.0",
        //         "exchange_fees" => {
        //           "btc_jpy" => array( taker_fee => '0.0', maker_fee => "0.0" ),
        //           "etc_jpy" => array( taker_fee => '0.0', maker_fee => "0.0" ),
        //           "fct_jpy" => array( taker_fee => '0.0', maker_fee => "0.0" ),
        //           "mona_jpy" => array( taker_fee => '0.0', maker_fee => "0.0" ),
        //           "plt_jpy" => array( taker_fee => '0.0', maker_fee => "0.0" )
        //         }
        //     }
        //
        $fees = $this->safe_value($response, 'exchange_fees', array());
        $result = array();
        for ($i = 0; $i < count($this->symbols); $i++) {
            $symbol = $this->symbols[$i];
            $market = $this->market($symbol);
            $fee = $this->safe_value($fees, $market['id'], array());
            $result[$symbol] = array(
                'info' => $fee,
                'symbol' => $symbol,
                'maker' => $this->safe_number($fee, 'maker_fee'),
                'taker' => $this->safe_number($fee, 'taker_fee'),
                'percentage' => true,
                'tierBased' => false,
            );
        }
        return $result;
    }

    public function create_order(string $symbol, string $type, string $side, $amount, $price = null, $params = array ()) {
        /**
         * create a trade order
         * @param {string} $symbol unified $symbol of the $market to create an order in
         * @param {string} $type 'market' or 'limit'
         * @param {string} $side 'buy' or 'sell'
         * @param {float} $amount how much of currency you want to trade in units of base currency
         * @param {float} [$price] the $price at which the order is to be fullfilled, in units of the quote currency, ignored in $market orders
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array} an {@link https://github.com/ccxt/ccxt/wiki/Manual#order-structure order structure}
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'pair' => $market['id'],
        );
        if ($type === 'market') {
            $order_type = $type . '_' . $side;
            $request['order_type'] = $order_type;
            $prefix = ($side === 'buy') ? ($order_type . '_') : '';
            $request[$prefix . 'amount'] = $amount;
        } else {
            $request['order_type'] = $side;
            $request['rate'] = $price;
            $request['amount'] = $amount;
        }
        $response = $this->privatePostExchangeOrders (array_merge($request, $params));
        $id = $this->safe_string($response, 'id');
        return $this->safe_order(array(
            'id' => $id,
            'info' => $response,
        ), $market);
    }

    public function cancel_order(string $id, ?string $symbol = null, $params = array ()) {
        /**
         * cancels an open order
         * @param {string} $id order $id
         * @param {string} $symbol not used by coincheck cancelOrder ()
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array} An {@link https://github.com/ccxt/ccxt/wiki/Manual#order-structure order structure}
         */
        $request = array(
            'id' => $id,
        );
        return $this->privateDeleteExchangeOrdersId (array_merge($request, $params));
    }

    public function fetch_deposits(?string $code = null, ?int $since = null, ?int $limit = null, $params = array ()): array {
        /**
         * fetch all deposits made to an account
         * @param {string} $code unified $currency $code
         * @param {int} [$since] the earliest time in ms to fetch deposits for
         * @param {int} [$limit] the maximum number of deposits structures to retrieve
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array[]} a list of {@link https://github.com/ccxt/ccxt/wiki/Manual#transaction-structure transaction structures}
         */
        $this->load_markets();
        $currency = null;
        $request = array();
        if ($code !== null) {
            $currency = $this->currency($code);
            $request['currency'] = $currency['id'];
        }
        if ($limit !== null) {
            $request['limit'] = $limit;
        }
        $response = $this->privateGetDepositMoney (array_merge($request, $params));
        // {
        //   "success" => true,
        //   "deposits" => array(
        //     array(
        //       "id" => 2,
        //       "amount" => "0.05",
        //       "currency" => "BTC",
        //       "address" => "13PhzoK8me3u5nHzzFD85qT9RqEWR9M4Ty",
        //       "status" => "confirmed",
        //       "confirmed_at" => "2015-06-13T08:29:18.000Z",
        //       "created_at" => "2015-06-13T08:22:18.000Z"
        //     ),
        //     {
        //       "id" => 1,
        //       "amount" => "0.01",
        //       "currency" => "BTC",
        //       "address" => "13PhzoK8me3u5nHzzFD85qT9RqEWR9M4Ty",
        //       "status" => "received",
        //       "confirmed_at" => "2015-06-13T08:21:18.000Z",
        //       "created_at" => "2015-06-13T08:21:18.000Z"
        //     }
        //   )
        // }
        $data = $this->safe_value($response, 'deposits', array());
        return $this->parse_transactions($data, $currency, $since, $limit, array( 'type' => 'deposit' ));
    }

    public function fetch_withdrawals(?string $code = null, ?int $since = null, ?int $limit = null, $params = array ()): array {
        /**
         * fetch all withdrawals made from an account
         * @param {string} $code unified $currency $code
         * @param {int} [$since] the earliest time in ms to fetch withdrawals for
         * @param {int} [$limit] the maximum number of withdrawals structures to retrieve
         * @param {array} [$params] extra parameters specific to the coincheck api endpoint
         * @return {array[]} a list of {@link https://github.com/ccxt/ccxt/wiki/Manual#transaction-structure transaction structures}
         */
        $this->load_markets();
        $currency = null;
        if ($code !== null) {
            $currency = $this->currency($code);
        }
        $request = array();
        if ($limit !== null) {
            $request['limit'] = $limit;
        }
        $response = $this->privateGetWithdraws (array_merge($request, $params));
        //  {
        //   "success" => true,
        //   "pagination" => array(
        //     "limit" => 25,
        //     "order" => "desc",
        //     "starting_after" => null,
        //     "ending_before" => null
        //   ),
        //   "data" => array(
        //     {
        //       "id" => 398,
        //       "status" => "finished",
        //       "amount" => "242742.0",
        //       "currency" => "JPY",
        //       "created_at" => "2014-12-04T15:00:00.000Z",
        //       "bank_account_id" => 243,
        //       "fee" => "400.0",
        //       "is_fast" => true
        //     }
        //   )
        // }
        $data = $this->safe_value($response, 'data', array());
        return $this->parse_transactions($data, $currency, $since, $limit, array( 'type' => 'withdrawal' ));
    }

    public function parse_transaction_status($status) {
        $statuses = array(
            // withdrawals
            'pending' => 'pending',
            'processing' => 'pending',
            'finished' => 'ok',
            'canceled' => 'canceled',
            // deposits
            'confirmed' => 'pending',
            'received' => 'ok',
        );
        return $this->safe_string($statuses, $status, $status);
    }

    public function parse_transaction($transaction, $currency = null): array {
        //
        // fetchDeposits
        //
        // {
        //       "id" => 2,
        //       "amount" => "0.05",
        //       "currency" => "BTC",
        //       "address" => "13PhzoK8me3u5nHzzFD85qT9RqEWR9M4Ty",
        //       "status" => "confirmed",
        //       "confirmed_at" => "2015-06-13T08:29:18.000Z",
        //       "created_at" => "2015-06-13T08:22:18.000Z"
        //  }
        //
        // fetchWithdrawals
        //
        //  {
        //       "id" => 398,
        //       "status" => "finished",
        //       "amount" => "242742.0",
        //       "currency" => "JPY",
        //       "created_at" => "2014-12-04T15:00:00.000Z",
        //       "bank_account_id" => 243,
        //       "fee" => "400.0",
        //       "is_fast" => true
        //  }
        //
        $id = $this->safe_string($transaction, 'id');
        $timestamp = $this->parse8601($this->safe_string($transaction, 'created_at'));
        $address = $this->safe_string($transaction, 'address');
        $amount = $this->safe_number($transaction, 'amount');
        $currencyId = $this->safe_string($transaction, 'currency');
        $code = $this->safe_currency_code($currencyId, $currency);
        $status = $this->parse_transaction_status($this->safe_string($transaction, 'status'));
        $updated = $this->parse8601($this->safe_string($transaction, 'confirmed_at'));
        $fee = null;
        $feeCost = $this->safe_number($transaction, 'fee');
        if ($feeCost !== null) {
            $fee = array(
                'cost' => $feeCost,
                'currency' => $code,
            );
        }
        return array(
            'info' => $transaction,
            'id' => $id,
            'txid' => null,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'network' => null,
            'address' => $address,
            'addressTo' => $address,
            'addressFrom' => null,
            'tag' => null,
            'tagTo' => null,
            'tagFrom' => null,
            'type' => null,
            'amount' => $amount,
            'currency' => $code,
            'status' => $status,
            'updated' => $updated,
            'comment' => null,
            'internal' => null,
            'fee' => $fee,
        );
    }

    public function nonce() {
        return $this->milliseconds();
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $url = $this->urls['api']['rest'] . '/' . $this->implode_params($path, $params);
        $query = $this->omit($params, $this->extract_params($path));
        if ($api === 'public') {
            if ($query) {
                $url .= '?' . $this->urlencode($query);
            }
        } else {
            $this->check_required_credentials();
            $nonce = (string) $this->nonce();
            $queryString = '';
            if ($method === 'GET') {
                if ($query) {
                    $url .= '?' . $this->urlencode($this->keysort($query));
                }
            } else {
                if ($query) {
                    $body = $this->urlencode($this->keysort($query));
                    $queryString = $body;
                }
            }
            $auth = $nonce . $url . $queryString;
            $headers = array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'ACCESS-KEY' => $this->apiKey,
                'ACCESS-NONCE' => $nonce,
                'ACCESS-SIGNATURE' => $this->hmac($this->encode($auth), $this->encode($this->secret), 'sha256'),
            );
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function handle_errors($httpCode, $reason, $url, $method, $headers, $body, $response, $requestHeaders, $requestBody) {
        if ($response === null) {
            return null;
        }
        //
        //     array("success":false,"error":"disabled API Key")'
        //     array("success":false,"error":"invalid authentication")
        //
        $success = $this->safe_value($response, 'success', true);
        if (!$success) {
            $error = $this->safe_string($response, 'error');
            $feedback = $this->id . ' ' . $this->json($response);
            $this->throw_exactly_matched_exception($this->exceptions['exact'], $error, $feedback);
            $this->throw_broadly_matched_exception($this->exceptions['broad'], $body, $feedback);
            throw new ExchangeError($this->id . ' ' . $this->json($response));
        }
        return null;
    }
}
