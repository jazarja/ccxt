<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class upbit extends \ccxt\async\Exchange {
    public function public_get_market_all($params = array()) {
        return $this->request('market/all', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_timeframe($params = array()) {
        return $this->request('candles/{timeframe}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_timeframe_unit($params = array()) {
        return $this->request('candles/{timeframe}/{unit}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_unit($params = array()) {
        return $this->request('candles/minutes/{unit}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_1($params = array()) {
        return $this->request('candles/minutes/1', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_3($params = array()) {
        return $this->request('candles/minutes/3', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_5($params = array()) {
        return $this->request('candles/minutes/5', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_15($params = array()) {
        return $this->request('candles/minutes/15', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_30($params = array()) {
        return $this->request('candles/minutes/30', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_60($params = array()) {
        return $this->request('candles/minutes/60', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_minutes_240($params = array()) {
        return $this->request('candles/minutes/240', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_days($params = array()) {
        return $this->request('candles/days', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_weeks($params = array()) {
        return $this->request('candles/weeks', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candles_months($params = array()) {
        return $this->request('candles/months', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_trades_ticks($params = array()) {
        return $this->request('trades/ticks', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_ticker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_orderbook($params = array()) {
        return $this->request('orderbook', 'public', 'GET', $params, null, null, array());
    }
    public function private_get_accounts($params = array()) {
        return $this->request('accounts', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_orders_chance($params = array()) {
        return $this->request('orders/chance', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_order($params = array()) {
        return $this->request('order', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_orders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_withdraws($params = array()) {
        return $this->request('withdraws', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_withdraw($params = array()) {
        return $this->request('withdraw', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_withdraws_chance($params = array()) {
        return $this->request('withdraws/chance', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_deposits($params = array()) {
        return $this->request('deposits', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_deposit($params = array()) {
        return $this->request('deposit', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_deposits_coin_addresses($params = array()) {
        return $this->request('deposits/coin_addresses', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_deposits_coin_address($params = array()) {
        return $this->request('deposits/coin_address', 'private', 'GET', $params, null, null, array());
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_withdraws_coin($params = array()) {
        return $this->request('withdraws/coin', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_withdraws_krw($params = array()) {
        return $this->request('withdraws/krw', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_deposits_generate_coin_address($params = array()) {
        return $this->request('deposits/generate_coin_address', 'private', 'POST', $params, null, null, array());
    }
    public function private_delete_order($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params, null, null, array());
    }
    public function publicGetMarketAll($params = array()) {
        return $this->request('market/all', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesTimeframe($params = array()) {
        return $this->request('candles/{timeframe}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesTimeframeUnit($params = array()) {
        return $this->request('candles/{timeframe}/{unit}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutesUnit($params = array()) {
        return $this->request('candles/minutes/{unit}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes1($params = array()) {
        return $this->request('candles/minutes/1', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes3($params = array()) {
        return $this->request('candles/minutes/3', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes5($params = array()) {
        return $this->request('candles/minutes/5', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes15($params = array()) {
        return $this->request('candles/minutes/15', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes30($params = array()) {
        return $this->request('candles/minutes/30', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes60($params = array()) {
        return $this->request('candles/minutes/60', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMinutes240($params = array()) {
        return $this->request('candles/minutes/240', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesDays($params = array()) {
        return $this->request('candles/days', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesWeeks($params = array()) {
        return $this->request('candles/weeks', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlesMonths($params = array()) {
        return $this->request('candles/months', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTradesTicks($params = array()) {
        return $this->request('trades/ticks', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTicker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetOrderbook($params = array()) {
        return $this->request('orderbook', 'public', 'GET', $params, null, null, array());
    }
    public function privateGetAccounts($params = array()) {
        return $this->request('accounts', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetOrdersChance($params = array()) {
        return $this->request('orders/chance', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetOrder($params = array()) {
        return $this->request('order', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetOrders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetWithdraws($params = array()) {
        return $this->request('withdraws', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetWithdraw($params = array()) {
        return $this->request('withdraw', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetWithdrawsChance($params = array()) {
        return $this->request('withdraws/chance', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetDeposits($params = array()) {
        return $this->request('deposits', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetDeposit($params = array()) {
        return $this->request('deposit', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetDepositsCoinAddresses($params = array()) {
        return $this->request('deposits/coin_addresses', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetDepositsCoinAddress($params = array()) {
        return $this->request('deposits/coin_address', 'private', 'GET', $params, null, null, array());
    }
    public function privatePostOrders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostWithdrawsCoin($params = array()) {
        return $this->request('withdraws/coin', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostWithdrawsKrw($params = array()) {
        return $this->request('withdraws/krw', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostDepositsGenerateCoinAddress($params = array()) {
        return $this->request('deposits/generate_coin_address', 'private', 'POST', $params, null, null, array());
    }
    public function privateDeleteOrder($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params, null, null, array());
    }
}
