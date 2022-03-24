'use strict';

//  ---------------------------------------------------------------------------

const ccxt = require ('ccxt');
const { AuthenticationError } = require ('ccxt/js/base/errors');
const { ArrayCache, ArrayCacheByTimestamp } = require ('./base/Cache');

//  ---------------------------------------------------------------------------

module.exports = class cryptocom extends ccxt.cryptocom {
    describe () {
        return this.deepExtend (super.describe (), {
            'has': {
                'ws': true,
                'watchBalance': true,
                'watchTicker': true,
                'watchTickers': false, // for now
                'watchTrades': true,
                'watchOrderBook': true,
                'watchOHLCV': true,
            },
            'urls': {
                'api': {
                    'ws': {
                        'public': 'wss://stream.crypto.com/v2/market',
                        'private': 'wss://stream.crypto.com/v2/user',
                    },
                },
                'test': {
                    'public': 'wss://uat-stream.3ona.co/v2/market',
                    'private': 'wss://uat-stream.3ona.co/v2/user',
                },
            },
            'options': {
            },
            'streaming': {
            },
        });
    }

    async pong (client, message) {
        // {
        //     "id": 1587523073344,
        //     "method": "public/heartbeat",
        //     "code": 0
        // }
        await client.send ({ 'id': this.safeInteger (message, 'id'), 'method': 'public/respond-heartbeat' });
    }

    async watchTrades (symbol, since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        const messageHash = 'trade' + '.' + market['id'];
        const trades = await this.watchPublic (messageHash, params);
        if (this.newUpdates) {
            limit = trades.getLimit (symbol, limit);
        }
        return this.filterBySinceLimit (trades, since, limit, 'timestamp', true);
    }

    handleTrades (client, message) {
        //
        // {
        //     code: 0,
        //     method: 'subscribe',
        //     result: {
        //       instrument_name: 'BTC_USDT',
        //       subscription: 'trade.BTC_USDT',
        //       channel: 'trade',
        //       data: [
        //             {
        //                 "dataTime":1648122434405,
        //                 "d":"2358394540212355488",
        //                 "s":"SELL",
        //                 "p":42980.85,
        //                 "q":0.002325,
        //                 "t":1648122434404,
        //                 "i":"BTC_USDT"
        //              }
        //              (...)
        //       ]
        // }
        //
        const messageHash = this.safeString (message, 'subscription');
        const marketId = this.safeString (message, 'instrument_name');
        const market = this.safeMarket (marketId);
        const symbol = market['symbol'];
        let stored = this.safeValue (this.trades, symbol);
        if (stored === undefined) {
            const limit = this.safeInteger (this.options, 'tradesLimit', 1000);
            stored = new ArrayCache (limit);
            this.trades[symbol] = stored;
        }
        const data = this.safeValue (message, 'data', []);
        const parsedTrades = this.parseTrades (data, market);
        for (let j = 0; j < parsedTrades.length; j++) {
            stored.append (parsedTrades[j]);
        }
        client.resolve (stored, messageHash);
    }

    async watchTicker (symbol, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        const messageHash = 'ticker' + '.' + market['id'];
        return await this.watchPublic (messageHash, params);
    }

    handleTicker (client, message) {
        //
        // {
        //     "info":{
        //        "instrument_name":"BTC_USDT",
        //        "subscription":"ticker.BTC_USDT",
        //        "channel":"ticker",
        //        "data":[
        //           {
        //              "i":"BTC_USDT",
        //              "b":43063.19,
        //              "k":43063.2,
        //              "a":43063.19,
        //              "t":1648121165658,
        //              "v":43573.912409,
        //              "h":43498.51,
        //              "l":41876.58,
        //              "c":1087.43
        //           }
        //        ]
        //     }
        //  }
        //
        const messageHash = this.safeString (message, 'subscription');
        const marketId = this.safeString (message, 'instrument_name');
        const market = this.safeMarket (marketId);
        const data = this.safeValue (message, 'data', []);
        for (let i = 0; i < data.length; i++) {
            const ticker = data[i];
            const parsed = this.parseTicker (ticker, market);
            const symbol = parsed['symbol'];
            this.tickers[symbol] = parsed;
            client.resolve (parsed, messageHash);
        }
    }

    async watchOHLCV (symbol, timeframe = '1m', since = undefined, limit = undefined, params = {}) {
        await this.loadMarkets ();
        const market = this.market (symbol);
        const interval = this.timeframes[timeframe];
        const messageHash = 'candlestick' + '.' + interval + '.' + market['id'];
        const ohlcv = await this.watchPublic (messageHash, params);
        if (this.newUpdates) {
            limit = ohlcv.getLimit (symbol, limit);
        }
        return this.filterBySinceLimit (ohlcv, since, limit, 0, true);
    }

    handleOHLCV (client, message) {
        //
        //  {
        //       instrument_name: 'BTC_USDT',
        //       subscription: 'candlestick.1m.BTC_USDT',
        //       channel: 'candlestick',
        //       depth: 300,
        //       interval: '1m',
        //       data: [ [Object] ]
        //   }
        //
        const messageHash = this.safeString (message, 'subscription');
        const marketId = this.safeString (message, 'instrument_name');
        const market = this.safeMarket (marketId);
        const symbol = market['symbol'];
        const interval = this.safeString (message, 'interval');
        const timeframe = this.findTimeframe (interval);
        this.ohlcvs[symbol] = this.safeValue (this.ohlcvs, symbol, {});
        let stored = this.safeValue (this.ohlcvs[symbol], timeframe);
        if (stored === undefined) {
            const limit = this.safeInteger (this.options, 'OHLCVLimit', 1000);
            stored = new ArrayCacheByTimestamp (limit);
            this.ohlcvs[symbol][timeframe] = stored;
        }
        const data = this.safeValue (message, 'data');
        for (let i = 0; i < data.length; i++) {
            const tick = data[i];
            const parsed = this.parseOHLCV (tick, market);
            stored.append (parsed);
        }
        client.resolve (stored, messageHash);
    }

    async watchPublic (messageHash, params = {}) {
        const url = this.urls['api']['ws']['public'];
        const id = this.nonce ();
        const request = {
            'method': 'subscribe',
            'params': {
                'channels': [messageHash],
            },
            'nonce': id,
        };
        const message = this.extend (request, params);
        return await this.watch (url, messageHash, message, messageHash);
    }

    handleErrorMessage (client, message) {
        // {
        //     id: 0,
        //     code: 10004,
        //     method: 'subscribe',
        //     message: 'invalid channel {"channels":["trade.BTCUSD-PERP"]}'
        // }
        const errorCode = this.safeInteger (message, 'code');
        try {
            if (errorCode !== undefined && errorCode !== 0) {
                const feedback = this.id + ' ' + this.json (message);
                this.throwExactlyMatchedException (this.exceptions['exact'], errorCode, feedback);
                const messageString = this.safeValue (message, 'message');
                if (messageString !== undefined) {
                    this.throwBroadlyMatchedException (this.exceptions['broad'], messageString, feedback);
                }
            }
        } catch (e) {
            if (e instanceof AuthenticationError) {
                client.reject (e, 'authenticated');
                const method = 'auth';
                if (method in client.subscriptions) {
                    delete client.subscriptions[method];
                }
                return false;
            } else {
                client.reject (e);
            }
        }
        return message;
    }

    handleMessage (client, message) {
        // ping
        // {
        //     "id": 1587523073344,
        //     "method": "public/heartbeat",
        //     "code": 0
        // }
        // ohlcv
        // {
        //     code: 0,
        //     method: 'subscribe',
        //     result: {
        //       instrument_name: 'BTC_USDT',
        //       subscription: 'candlestick.1m.BTC_USDT',
        //       channel: 'candlestick',
        //       depth: 300,
        //       interval: '1m',
        //       data: [ [Object] ]
        //     }
        //   }
        // ticker
        // {
        //     "info":{
        //        "instrument_name":"BTC_USDT",
        //        "subscription":"ticker.BTC_USDT",
        //        "channel":"ticker",
        //        "data":[ { } ]
        //
        if (!this.handleErrorMessage (client, message)) {
            return;
        }
        const subject = this.safeString (message, 'method');
        if (subject === 'public/heartbeat') {
            this.pong (client, message);
            return;
        }
        const methods = {
            'candlestick': this.handleOHLCV,
            'ticker': this.handleTicker,
            'trade': this.handleTrades,
        };
        const result = this.safeValue2 (message, 'result', 'info');
        const channel = this.safeString (result, 'channel');
        const method = this.safeValue (methods, channel);
        if (method !== undefined) {
            method.call (this, client, result);
        }
    }
};
