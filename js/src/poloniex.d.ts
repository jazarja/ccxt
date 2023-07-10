import Exchange from './abstract/poloniex.js';
import { Int, OrderSide, OrderType } from './base/types.js';
/**
 * @class poloniex
 * @extends Exchange
 */
export default class poloniex extends Exchange {
    describe(): any;
    parseOHLCV(ohlcv: any, market?: any): number[];
    fetchOHLCV(symbol: string, timeframe?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").OHLCV[]>;
    loadMarkets(reload?: boolean, params?: {}): Promise<import("./base/types.js").Dictionary<import("./base/types.js").Market>>;
    fetchMarkets(params?: {}): Promise<any[]>;
    fetchTime(params?: {}): Promise<number>;
    parseTicker(ticker: any, market?: any): import("./base/types.js").Ticker;
    fetchTickers(symbols?: string[], params?: {}): Promise<import("./base/types.js").Dictionary<import("./base/types.js").Ticker>>;
    fetchCurrencies(params?: {}): Promise<{}>;
    fetchTicker(symbol: string, params?: {}): Promise<import("./base/types.js").Ticker>;
    parseTrade(trade: any, market?: any): import("./base/types.js").Trade;
    fetchTrades(symbol: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").Trade[]>;
    fetchMyTrades(symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    parseOrderStatus(status: any): string;
    parseOrder(order: any, market?: any): import("./base/types.js").Order;
    parseOrderType(status: any): string;
    parseOpenOrders(orders: any, market: any, result: any): any;
    fetchOpenOrders(symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").Order[]>;
    createOrder(symbol: string, type: OrderType, side: OrderSide, amount: any, price?: any, params?: {}): Promise<import("./base/types.js").Order>;
    orderRequest(symbol: any, type: any, side: any, amount: any, request: any, price?: any, params?: {}): any[];
    editOrder(id: string, symbol: any, type: any, side: any, amount?: any, price?: any, params?: {}): Promise<import("./base/types.js").Order>;
    cancelOrder(id: string, symbol?: string, params?: {}): Promise<any>;
    cancelAllOrders(symbol?: string, params?: {}): Promise<any>;
    fetchOrder(id: string, symbol?: string, params?: {}): Promise<any>;
    fetchOrderStatus(id: string, symbol?: string, params?: {}): Promise<"open" | "closed">;
    fetchOrderTrades(id: string, symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").Trade[]>;
    parseBalance(response: any): import("./base/types.js").Balances;
    fetchBalance(params?: {}): Promise<import("./base/types.js").Balances>;
    fetchTradingFees(params?: {}): Promise<{}>;
    fetchOrderBook(symbol: string, limit?: Int, params?: {}): Promise<any>;
    createDepositAddress(code: string, params?: {}): Promise<{
        currency: string;
        address: string;
        tag: any;
        network: string;
        info: any;
    }>;
    fetchDepositAddress(code: string, params?: {}): Promise<{
        currency: string;
        address: string;
        tag: any;
        network: string;
        info: any;
    }>;
    transfer(code: string, amount: any, fromAccount: any, toAccount: any, params?: {}): Promise<{
        info: any;
        id: string;
        timestamp: any;
        datetime: any;
        currency: string;
        amount: any;
        fromAccount: any;
        toAccount: any;
        status: any;
    }>;
    parseTransfer(transfer: any, currency?: any): {
        info: any;
        id: string;
        timestamp: any;
        datetime: any;
        currency: string;
        amount: any;
        fromAccount: any;
        toAccount: any;
        status: any;
    };
    withdraw(code: string, amount: any, address: any, tag?: any, params?: {}): Promise<{
        info: any;
        id: string;
        currency: any;
        amount: number;
        network: any;
        address: string;
        addressTo: any;
        addressFrom: any;
        tag: string;
        tagTo: any;
        tagFrom: any;
        status: string;
        type: string;
        updated: any;
        txid: string;
        timestamp: number;
        datetime: string;
        comment: any;
        fee: {
            currency: any;
            cost: number;
            rate: any;
        };
    }>;
    fetchTransactionsHelper(code?: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    fetchTransactions(code?: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    fetchWithdrawals(code?: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    fetchDepositWithdrawFees(codes?: string[], params?: {}): Promise<{}>;
    parseDepositWithdrawFees(response: any, codes?: any, currencyIdKey?: any): {};
    parseDepositWithdrawFee(fee: any, currency?: any): any;
    fetchDeposits(code?: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    parseTransactionStatus(status: any): string;
    parseTransaction(transaction: any, currency?: any): {
        info: any;
        id: string;
        currency: any;
        amount: number;
        network: any;
        address: string;
        addressTo: any;
        addressFrom: any;
        tag: string;
        tagTo: any;
        tagFrom: any;
        status: string;
        type: string;
        updated: any;
        txid: string;
        timestamp: number;
        datetime: string;
        comment: any;
        fee: {
            currency: any;
            cost: number;
            rate: any;
        };
    };
    nonce(): number;
    sign(path: any, api?: string, method?: string, params?: {}, headers?: any, body?: any): {
        url: any;
        method: string;
        body: any;
        headers: any;
    };
    handleErrors(code: any, reason: any, url: any, method: any, headers: any, body: any, response: any, requestHeaders: any, requestBody: any): any;
}
