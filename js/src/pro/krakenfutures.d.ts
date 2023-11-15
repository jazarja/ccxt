import krakenfuturesRest from '../krakenfutures.js';
import { Int, Str } from '../base/types.js';
import Client from '../base/ws/Client.js';
export default class krakenfutures extends krakenfuturesRest {
    describe(): any;
    authenticate(params?: {}): Promise<any>;
    subscribePublic(name: string, symbols: string[], params?: {}): Promise<any>;
    subscribePrivate(name: string, messageHash: string, params?: {}): Promise<any>;
    watchTicker(symbol: string, params?: {}): Promise<any>;
    watchTickers(symbols?: string[], params?: {}): Promise<any>;
    watchTrades(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<any>;
    watchOrderBook(symbol: string, limit?: Int, params?: {}): Promise<any>;
    watchPositions(symbols?: string[], since?: Int, limit?: Int, params?: {}): Promise<any>;
    handlePositions(client: any, message: any): void;
    parseWsPosition(position: any, market?: any): import("../base/types.js").Position;
    watchOrders(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<any>;
    watchMyTrades(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<any>;
    watchBalance(params?: {}): Promise<any>;
    handleTrade(client: Client, message: any): any;
    parseWsTrade(trade: any, market?: any): import("../base/types.js").Trade;
    parseWsOrderTrade(trade: any, market?: any): import("../base/types.js").Trade;
    handleOrder(client: Client, message: any): any;
    handleOrderSnapshot(client: Client, message: any): void;
    parseWsOrder(order: any, market?: any): import("../base/types.js").Order;
    handleTicker(client: Client, message: any): any;
    parseWsTicker(ticker: any, market?: any): import("../base/types.js").Ticker;
    handleOrderBookSnapshot(client: Client, message: any): void;
    handleOrderBook(client: Client, message: any): void;
    handleBalance(client: Client, message: any): void;
    handleMyTrades(client: Client, message: any): void;
    parseWsMyTrade(trade: any, market?: any): import("../base/types.js").Trade;
    handleMessage(client: any, message: any): any;
    handleAuthenticate(client: Client, message: any): any;
}
