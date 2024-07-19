from ccxt.base.types import Entry


class ImplicitAPI:
    public_get_currencies = publicGetCurrencies = Entry('currencies', 'public', 'GET', {'cost': 4.5})
    public_get_currencies_currency = publicGetCurrenciesCurrency = Entry('currencies/{currency}', 'public', 'GET', {'cost': 4.5})
    public_get_symbols = publicGetSymbols = Entry('symbols', 'public', 'GET', {'cost': 6})
    public_get_market_orderbook_level1 = publicGetMarketOrderbookLevel1 = Entry('market/orderbook/level1', 'public', 'GET', {'cost': 3})
    public_get_market_alltickers = publicGetMarketAllTickers = Entry('market/allTickers', 'public', 'GET', {'cost': 22.5})
    public_get_market_stats = publicGetMarketStats = Entry('market/stats', 'public', 'GET', {'cost': 22.5})
    public_get_markets = publicGetMarkets = Entry('markets', 'public', 'GET', {'cost': 4.5})
    public_get_market_orderbook_level_level_limit = publicGetMarketOrderbookLevelLevelLimit = Entry('market/orderbook/level{level}_{limit}', 'public', 'GET', {'cost': 6})
    public_get_market_orderbook_level2_20 = publicGetMarketOrderbookLevel220 = Entry('market/orderbook/level2_20', 'public', 'GET', {'cost': 3})
    public_get_market_orderbook_level2_100 = publicGetMarketOrderbookLevel2100 = Entry('market/orderbook/level2_100', 'public', 'GET', {'cost': 6})
    public_get_market_histories = publicGetMarketHistories = Entry('market/histories', 'public', 'GET', {'cost': 4.5})
    public_get_market_candles = publicGetMarketCandles = Entry('market/candles', 'public', 'GET', {'cost': 4.5})
    public_get_prices = publicGetPrices = Entry('prices', 'public', 'GET', {'cost': 4.5})
    public_get_timestamp = publicGetTimestamp = Entry('timestamp', 'public', 'GET', {'cost': 4.5})
    public_get_status = publicGetStatus = Entry('status', 'public', 'GET', {'cost': 4.5})
    public_get_mark_price_symbol_current = publicGetMarkPriceSymbolCurrent = Entry('mark-price/{symbol}/current', 'public', 'GET', {'cost': 3})
    public_get_mark_price_all_symbols = publicGetMarkPriceAllSymbols = Entry('mark-price/all-symbols', 'public', 'GET', {'cost': 3})
    public_get_margin_config = publicGetMarginConfig = Entry('margin/config', 'public', 'GET', {'cost': 25})
    public_post_bullet_public = publicPostBulletPublic = Entry('bullet-public', 'public', 'POST', {'cost': 15})
    private_get_user_info = privateGetUserInfo = Entry('user-info', 'private', 'GET', {'cost': 30})
    private_get_accounts = privateGetAccounts = Entry('accounts', 'private', 'GET', {'cost': 7.5})
    private_get_accounts_accountid = privateGetAccountsAccountId = Entry('accounts/{accountId}', 'private', 'GET', {'cost': 7.5})
    private_get_accounts_ledgers = privateGetAccountsLedgers = Entry('accounts/ledgers', 'private', 'GET', {'cost': 3})
    private_get_hf_accounts_ledgers = privateGetHfAccountsLedgers = Entry('hf/accounts/ledgers', 'private', 'GET', {'cost': 2})
    private_get_hf_margin_account_ledgers = privateGetHfMarginAccountLedgers = Entry('hf/margin/account/ledgers', 'private', 'GET', {'cost': 2})
    private_get_transaction_history = privateGetTransactionHistory = Entry('transaction-history', 'private', 'GET', {'cost': 3})
    private_get_sub_user = privateGetSubUser = Entry('sub/user', 'private', 'GET', {'cost': 30})
    private_get_sub_accounts_subuserid = privateGetSubAccountsSubUserId = Entry('sub-accounts/{subUserId}', 'private', 'GET', {'cost': 22.5})
    private_get_sub_accounts = privateGetSubAccounts = Entry('sub-accounts', 'private', 'GET', {'cost': 30})
    private_get_sub_api_key = privateGetSubApiKey = Entry('sub/api-key', 'private', 'GET', {'cost': 30})
    private_get_margin_account = privateGetMarginAccount = Entry('margin/account', 'private', 'GET', {'cost': 40})
    private_get_margin_accounts = privateGetMarginAccounts = Entry('margin/accounts', 'private', 'GET', {'cost': 15})
    private_get_isolated_accounts = privateGetIsolatedAccounts = Entry('isolated/accounts', 'private', 'GET', {'cost': 15})
    private_get_deposit_addresses = privateGetDepositAddresses = Entry('deposit-addresses', 'private', 'GET', {'cost': 7.5})
    private_get_deposits = privateGetDeposits = Entry('deposits', 'private', 'GET', {'cost': 7.5})
    private_get_hist_deposits = privateGetHistDeposits = Entry('hist-deposits', 'private', 'GET', {'cost': 7.5})
    private_get_withdrawals = privateGetWithdrawals = Entry('withdrawals', 'private', 'GET', {'cost': 30})
    private_get_hist_withdrawals = privateGetHistWithdrawals = Entry('hist-withdrawals', 'private', 'GET', {'cost': 30})
    private_get_withdrawals_quotas = privateGetWithdrawalsQuotas = Entry('withdrawals/quotas', 'private', 'GET', {'cost': 30})
    private_get_accounts_transferable = privateGetAccountsTransferable = Entry('accounts/transferable', 'private', 'GET', {'cost': 30})
    private_get_transfer_list = privateGetTransferList = Entry('transfer-list', 'private', 'GET', {'cost': 30})
    private_get_base_fee = privateGetBaseFee = Entry('base-fee', 'private', 'GET', {'cost': 3})
    private_get_trade_fees = privateGetTradeFees = Entry('trade-fees', 'private', 'GET', {'cost': 3})
    private_get_market_orderbook_level_level = privateGetMarketOrderbookLevelLevel = Entry('market/orderbook/level{level}', 'private', 'GET', {'cost': 3})
    private_get_market_orderbook_level2 = privateGetMarketOrderbookLevel2 = Entry('market/orderbook/level2', 'private', 'GET', {'cost': 3})
    private_get_market_orderbook_level3 = privateGetMarketOrderbookLevel3 = Entry('market/orderbook/level3', 'private', 'GET', {'cost': 3})
    private_get_hf_orders_active = privateGetHfOrdersActive = Entry('hf/orders/active', 'private', 'GET', {'cost': 2})
    private_get_hf_orders_active_symbols = privateGetHfOrdersActiveSymbols = Entry('hf/orders/active/symbols', 'private', 'GET', {'cost': 2})
    private_get_hf_margin_order_active_symbols = privateGetHfMarginOrderActiveSymbols = Entry('hf/margin/order/active/symbols', 'private', 'GET', {'cost': 2})
    private_get_hf_orders_done = privateGetHfOrdersDone = Entry('hf/orders/done', 'private', 'GET', {'cost': 2})
    private_get_hf_orders_orderid = privateGetHfOrdersOrderId = Entry('hf/orders/{orderId}', 'private', 'GET', {'cost': 2})
    private_get_hf_orders_client_order_clientoid = privateGetHfOrdersClientOrderClientOid = Entry('hf/orders/client-order/{clientOid}', 'private', 'GET', {'cost': 2})
    private_get_hf_orders_dead_cancel_all_query = privateGetHfOrdersDeadCancelAllQuery = Entry('hf/orders/dead-cancel-all/query', 'private', 'GET', {'cost': 2})
    private_get_hf_fills = privateGetHfFills = Entry('hf/fills', 'private', 'GET', {'cost': 2})
    private_get_orders = privateGetOrders = Entry('orders', 'private', 'GET', {'cost': 2})
    private_get_limit_orders = privateGetLimitOrders = Entry('limit/orders', 'private', 'GET', {'cost': 3})
    private_get_orders_orderid = privateGetOrdersOrderId = Entry('orders/{orderId}', 'private', 'GET', {'cost': 2})
    private_get_order_client_order_clientoid = privateGetOrderClientOrderClientOid = Entry('order/client-order/{clientOid}', 'private', 'GET', {'cost': 3})
    private_get_fills = privateGetFills = Entry('fills', 'private', 'GET', {'cost': 10})
    private_get_limit_fills = privateGetLimitFills = Entry('limit/fills', 'private', 'GET', {'cost': 20})
    private_get_stop_order = privateGetStopOrder = Entry('stop-order', 'private', 'GET', {'cost': 8})
    private_get_stop_order_orderid = privateGetStopOrderOrderId = Entry('stop-order/{orderId}', 'private', 'GET', {'cost': 3})
    private_get_stop_order_queryorderbyclientoid = privateGetStopOrderQueryOrderByClientOid = Entry('stop-order/queryOrderByClientOid', 'private', 'GET', {'cost': 3})
    private_get_oco_order_orderid = privateGetOcoOrderOrderId = Entry('oco/order/{orderId}', 'private', 'GET', {'cost': 2})
    private_get_oco_order_details_orderid = privateGetOcoOrderDetailsOrderId = Entry('oco/order/details/{orderId}', 'private', 'GET', {'cost': 2})
    private_get_oco_client_order_clientoid = privateGetOcoClientOrderClientOid = Entry('oco/client-order/{clientOid}', 'private', 'GET', {'cost': 2})
    private_get_oco_orders = privateGetOcoOrders = Entry('oco/orders', 'private', 'GET', {'cost': 2})
    private_get_hf_margin_orders_active = privateGetHfMarginOrdersActive = Entry('hf/margin/orders/active', 'private', 'GET', {'cost': 4})
    private_get_hf_margin_orders_done = privateGetHfMarginOrdersDone = Entry('hf/margin/orders/done', 'private', 'GET', {'cost': 10})
    private_get_hf_margin_orders_orderid = privateGetHfMarginOrdersOrderId = Entry('hf/margin/orders/{orderId}', 'private', 'GET', {'cost': 4})
    private_get_hf_margin_orders_client_order_clientoid = privateGetHfMarginOrdersClientOrderClientOid = Entry('hf/margin/orders/client-order/{clientOid}', 'private', 'GET', {'cost': 5})
    private_get_hf_margin_fills = privateGetHfMarginFills = Entry('hf/margin/fills', 'private', 'GET', {'cost': 5})
    private_get_etf_info = privateGetEtfInfo = Entry('etf/info', 'private', 'GET', {'cost': 25})
    private_get_margin_currencies = privateGetMarginCurrencies = Entry('margin/currencies', 'private', 'GET', {'cost': 20})
    private_get_risk_limit_strategy = privateGetRiskLimitStrategy = Entry('risk/limit/strategy', 'private', 'GET', {'cost': 20})
    private_get_isolated_symbols = privateGetIsolatedSymbols = Entry('isolated/symbols', 'private', 'GET', {'cost': 20})
    private_get_margin_symbols = privateGetMarginSymbols = Entry('margin/symbols', 'private', 'GET', {'cost': 5})
    private_get_isolated_account_symbol = privateGetIsolatedAccountSymbol = Entry('isolated/account/{symbol}', 'private', 'GET', {'cost': 50})
    private_get_margin_borrow = privateGetMarginBorrow = Entry('margin/borrow', 'private', 'GET', {'cost': 15})
    private_get_margin_repay = privateGetMarginRepay = Entry('margin/repay', 'private', 'GET', {'cost': 15})
    private_get_margin_interest = privateGetMarginInterest = Entry('margin/interest', 'private', 'GET', {'cost': 20})
    private_get_project_list = privateGetProjectList = Entry('project/list', 'private', 'GET', {'cost': 10})
    private_get_project_marketinterestrate = privateGetProjectMarketInterestRate = Entry('project/marketInterestRate', 'private', 'GET', {'cost': 7.5})
    private_get_redeem_orders = privateGetRedeemOrders = Entry('redeem/orders', 'private', 'GET', {'cost': 10})
    private_get_purchase_orders = privateGetPurchaseOrders = Entry('purchase/orders', 'private', 'GET', {'cost': 10})
    private_get_broker_api_rebase_download = privateGetBrokerApiRebaseDownload = Entry('broker/api/rebase/download', 'private', 'GET', {'cost': 3})
    private_get_affiliate_inviter_statistics = privateGetAffiliateInviterStatistics = Entry('affiliate/inviter/statistics', 'private', 'GET', {'cost': 30})
    private_post_sub_user_created = privatePostSubUserCreated = Entry('sub/user/created', 'private', 'POST', {'cost': 22.5})
    private_post_sub_api_key = privatePostSubApiKey = Entry('sub/api-key', 'private', 'POST', {'cost': 30})
    private_post_sub_api_key_update = privatePostSubApiKeyUpdate = Entry('sub/api-key/update', 'private', 'POST', {'cost': 45})
    private_post_deposit_addresses = privatePostDepositAddresses = Entry('deposit-addresses', 'private', 'POST', {'cost': 30})
    private_post_withdrawals = privatePostWithdrawals = Entry('withdrawals', 'private', 'POST', {'cost': 7.5})
    private_post_accounts_universal_transfer = privatePostAccountsUniversalTransfer = Entry('accounts/universal-transfer', 'private', 'POST', {'cost': 6})
    private_post_accounts_sub_transfer = privatePostAccountsSubTransfer = Entry('accounts/sub-transfer', 'private', 'POST', {'cost': 45})
    private_post_accounts_inner_transfer = privatePostAccountsInnerTransfer = Entry('accounts/inner-transfer', 'private', 'POST', {'cost': 15})
    private_post_transfer_out = privatePostTransferOut = Entry('transfer-out', 'private', 'POST', {'cost': 30})
    private_post_transfer_in = privatePostTransferIn = Entry('transfer-in', 'private', 'POST', {'cost': 30})
    private_post_hf_orders = privatePostHfOrders = Entry('hf/orders', 'private', 'POST', {'cost': 1})
    private_post_hf_orders_test = privatePostHfOrdersTest = Entry('hf/orders/test', 'private', 'POST', {'cost': 1})
    private_post_hf_orders_sync = privatePostHfOrdersSync = Entry('hf/orders/sync', 'private', 'POST', {'cost': 1})
    private_post_hf_orders_multi = privatePostHfOrdersMulti = Entry('hf/orders/multi', 'private', 'POST', {'cost': 1})
    private_post_hf_orders_multi_sync = privatePostHfOrdersMultiSync = Entry('hf/orders/multi/sync', 'private', 'POST', {'cost': 1})
    private_post_hf_orders_alter = privatePostHfOrdersAlter = Entry('hf/orders/alter', 'private', 'POST', {'cost': 3})
    private_post_hf_orders_dead_cancel_all = privatePostHfOrdersDeadCancelAll = Entry('hf/orders/dead-cancel-all', 'private', 'POST', {'cost': 2})
    private_post_orders = privatePostOrders = Entry('orders', 'private', 'POST', {'cost': 2})
    private_post_orders_test = privatePostOrdersTest = Entry('orders/test', 'private', 'POST', {'cost': 2})
    private_post_orders_multi = privatePostOrdersMulti = Entry('orders/multi', 'private', 'POST', {'cost': 3})
    private_post_stop_order = privatePostStopOrder = Entry('stop-order', 'private', 'POST', {'cost': 2})
    private_post_oco_order = privatePostOcoOrder = Entry('oco/order', 'private', 'POST', {'cost': 2})
    private_post_hf_margin_order = privatePostHfMarginOrder = Entry('hf/margin/order', 'private', 'POST', {'cost': 5})
    private_post_hf_margin_order_test = privatePostHfMarginOrderTest = Entry('hf/margin/order/test', 'private', 'POST', {'cost': 5})
    private_post_margin_order = privatePostMarginOrder = Entry('margin/order', 'private', 'POST', {'cost': 5})
    private_post_margin_order_test = privatePostMarginOrderTest = Entry('margin/order/test', 'private', 'POST', {'cost': 5})
    private_post_margin_borrow = privatePostMarginBorrow = Entry('margin/borrow', 'private', 'POST', {'cost': 15})
    private_post_margin_repay = privatePostMarginRepay = Entry('margin/repay', 'private', 'POST', {'cost': 10})
    private_post_purchase = privatePostPurchase = Entry('purchase', 'private', 'POST', {'cost': 15})
    private_post_redeem = privatePostRedeem = Entry('redeem', 'private', 'POST', {'cost': 15})
    private_post_lend_purchase_update = privatePostLendPurchaseUpdate = Entry('lend/purchase/update', 'private', 'POST', {'cost': 10})
    private_post_bullet_private = privatePostBulletPrivate = Entry('bullet-private', 'private', 'POST', {'cost': 10})
    private_post_position_update_user_leverage = privatePostPositionUpdateUserLeverage = Entry('position/update-user-leverage', 'private', 'POST', {'cost': 5})
    private_delete_sub_api_key = privateDeleteSubApiKey = Entry('sub/api-key', 'private', 'DELETE', {'cost': 45})
    private_delete_withdrawals_withdrawalid = privateDeleteWithdrawalsWithdrawalId = Entry('withdrawals/{withdrawalId}', 'private', 'DELETE', {'cost': 30})
    private_delete_hf_orders_orderid = privateDeleteHfOrdersOrderId = Entry('hf/orders/{orderId}', 'private', 'DELETE', {'cost': 1})
    private_delete_hf_orders_sync_orderid = privateDeleteHfOrdersSyncOrderId = Entry('hf/orders/sync/{orderId}', 'private', 'DELETE', {'cost': 1})
    private_delete_hf_orders_client_order_clientoid = privateDeleteHfOrdersClientOrderClientOid = Entry('hf/orders/client-order/{clientOid}', 'private', 'DELETE', {'cost': 1})
    private_delete_hf_orders_sync_client_order_clientoid = privateDeleteHfOrdersSyncClientOrderClientOid = Entry('hf/orders/sync/client-order/{clientOid}', 'private', 'DELETE', {'cost': 1})
    private_delete_hf_orders_cancel_orderid = privateDeleteHfOrdersCancelOrderId = Entry('hf/orders/cancel/{orderId}', 'private', 'DELETE', {'cost': 2})
    private_delete_hf_orders = privateDeleteHfOrders = Entry('hf/orders', 'private', 'DELETE', {'cost': 2})
    private_delete_hf_orders_cancelall = privateDeleteHfOrdersCancelAll = Entry('hf/orders/cancelAll', 'private', 'DELETE', {'cost': 30})
    private_delete_orders_orderid = privateDeleteOrdersOrderId = Entry('orders/{orderId}', 'private', 'DELETE', {'cost': 3})
    private_delete_order_client_order_clientoid = privateDeleteOrderClientOrderClientOid = Entry('order/client-order/{clientOid}', 'private', 'DELETE', {'cost': 5})
    private_delete_orders = privateDeleteOrders = Entry('orders', 'private', 'DELETE', {'cost': 20})
    private_delete_stop_order_orderid = privateDeleteStopOrderOrderId = Entry('stop-order/{orderId}', 'private', 'DELETE', {'cost': 3})
    private_delete_stop_order_cancelorderbyclientoid = privateDeleteStopOrderCancelOrderByClientOid = Entry('stop-order/cancelOrderByClientOid', 'private', 'DELETE', {'cost': 5})
    private_delete_stop_order_cancel = privateDeleteStopOrderCancel = Entry('stop-order/cancel', 'private', 'DELETE', {'cost': 3})
    private_delete_oco_order_orderid = privateDeleteOcoOrderOrderId = Entry('oco/order/{orderId}', 'private', 'DELETE', {'cost': 3})
    private_delete_oco_client_order_clientoid = privateDeleteOcoClientOrderClientOid = Entry('oco/client-order/{clientOid}', 'private', 'DELETE', {'cost': 3})
    private_delete_oco_orders = privateDeleteOcoOrders = Entry('oco/orders', 'private', 'DELETE', {'cost': 3})
    private_delete_hf_margin_orders_orderid = privateDeleteHfMarginOrdersOrderId = Entry('hf/margin/orders/{orderId}', 'private', 'DELETE', {'cost': 5})
    private_delete_hf_margin_orders_client_order_clientoid = privateDeleteHfMarginOrdersClientOrderClientOid = Entry('hf/margin/orders/client-order/{clientOid}', 'private', 'DELETE', {'cost': 5})
    private_delete_hf_margin_orders = privateDeleteHfMarginOrders = Entry('hf/margin/orders', 'private', 'DELETE', {'cost': 10})
    futurespublic_get_contracts_active = futuresPublicGetContractsActive = Entry('contracts/active', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_contracts_symbol = futuresPublicGetContractsSymbol = Entry('contracts/{symbol}', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_ticker = futuresPublicGetTicker = Entry('ticker', 'futuresPublic', 'GET', {'cost': 3})
    futurespublic_get_level2_snapshot = futuresPublicGetLevel2Snapshot = Entry('level2/snapshot', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_level2_depth20 = futuresPublicGetLevel2Depth20 = Entry('level2/depth20', 'futuresPublic', 'GET', {'cost': 7.5})
    futurespublic_get_level2_depth100 = futuresPublicGetLevel2Depth100 = Entry('level2/depth100', 'futuresPublic', 'GET', {'cost': 15})
    futurespublic_get_trade_history = futuresPublicGetTradeHistory = Entry('trade/history', 'futuresPublic', 'GET', {'cost': 7.5})
    futurespublic_get_kline_query = futuresPublicGetKlineQuery = Entry('kline/query', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_interest_query = futuresPublicGetInterestQuery = Entry('interest/query', 'futuresPublic', 'GET', {'cost': 7.5})
    futurespublic_get_index_query = futuresPublicGetIndexQuery = Entry('index/query', 'futuresPublic', 'GET', {'cost': 3})
    futurespublic_get_mark_price_symbol_current = futuresPublicGetMarkPriceSymbolCurrent = Entry('mark-price/{symbol}/current', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_premium_query = futuresPublicGetPremiumQuery = Entry('premium/query', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_trade_statistics = futuresPublicGetTradeStatistics = Entry('trade-statistics', 'futuresPublic', 'GET', {'cost': 4.5})
    futurespublic_get_funding_rate_symbol_current = futuresPublicGetFundingRateSymbolCurrent = Entry('funding-rate/{symbol}/current', 'futuresPublic', 'GET', {'cost': 3})
    futurespublic_get_contract_funding_rates = futuresPublicGetContractFundingRates = Entry('contract/funding-rates', 'futuresPublic', 'GET', {'cost': 7.5})
    futurespublic_get_timestamp = futuresPublicGetTimestamp = Entry('timestamp', 'futuresPublic', 'GET', {'cost': 3})
    futurespublic_get_status = futuresPublicGetStatus = Entry('status', 'futuresPublic', 'GET', {'cost': 6})
    futurespublic_get_level2_message_query = futuresPublicGetLevel2MessageQuery = Entry('level2/message/query', 'futuresPublic', 'GET', {'cost': 1.3953})
    futurespublic_post_bullet_public = futuresPublicPostBulletPublic = Entry('bullet-public', 'futuresPublic', 'POST', {'cost': 15})
    futuresprivate_get_transaction_history = futuresPrivateGetTransactionHistory = Entry('transaction-history', 'futuresPrivate', 'GET', {'cost': 3})
    futuresprivate_get_account_overview = futuresPrivateGetAccountOverview = Entry('account-overview', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_get_account_overview_all = futuresPrivateGetAccountOverviewAll = Entry('account-overview-all', 'futuresPrivate', 'GET', {'cost': 9})
    futuresprivate_get_transfer_list = futuresPrivateGetTransferList = Entry('transfer-list', 'futuresPrivate', 'GET', {'cost': 30})
    futuresprivate_get_orders = futuresPrivateGetOrders = Entry('orders', 'futuresPrivate', 'GET', {'cost': 3})
    futuresprivate_get_stoporders = futuresPrivateGetStopOrders = Entry('stopOrders', 'futuresPrivate', 'GET', {'cost': 9})
    futuresprivate_get_recentdoneorders = futuresPrivateGetRecentDoneOrders = Entry('recentDoneOrders', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_get_orders_orderid = futuresPrivateGetOrdersOrderId = Entry('orders/{orderId}', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_get_orders_byclientoid = futuresPrivateGetOrdersByClientOid = Entry('orders/byClientOid', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_get_fills = futuresPrivateGetFills = Entry('fills', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_get_recentfills = futuresPrivateGetRecentFills = Entry('recentFills', 'futuresPrivate', 'GET', {'cost': 4.5})
    futuresprivate_get_openorderstatistics = futuresPrivateGetOpenOrderStatistics = Entry('openOrderStatistics', 'futuresPrivate', 'GET', {'cost': 15})
    futuresprivate_get_position = futuresPrivateGetPosition = Entry('position', 'futuresPrivate', 'GET', {'cost': 3})
    futuresprivate_get_positions = futuresPrivateGetPositions = Entry('positions', 'futuresPrivate', 'GET', {'cost': 3})
    futuresprivate_get_margin_maxwithdrawmargin = futuresPrivateGetMarginMaxWithdrawMargin = Entry('margin/maxWithdrawMargin', 'futuresPrivate', 'GET', {'cost': 15})
    futuresprivate_get_contracts_risk_limit_symbol = futuresPrivateGetContractsRiskLimitSymbol = Entry('contracts/risk-limit/{symbol}', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_get_funding_history = futuresPrivateGetFundingHistory = Entry('funding-history', 'futuresPrivate', 'GET', {'cost': 7.5})
    futuresprivate_post_transfer_out = futuresPrivatePostTransferOut = Entry('transfer-out', 'futuresPrivate', 'POST', {'cost': 30})
    futuresprivate_post_transfer_in = futuresPrivatePostTransferIn = Entry('transfer-in', 'futuresPrivate', 'POST', {'cost': 30})
    futuresprivate_post_orders = futuresPrivatePostOrders = Entry('orders', 'futuresPrivate', 'POST', {'cost': 3})
    futuresprivate_post_orders_test = futuresPrivatePostOrdersTest = Entry('orders/test', 'futuresPrivate', 'POST', {'cost': 3})
    futuresprivate_post_orders_multi = futuresPrivatePostOrdersMulti = Entry('orders/multi', 'futuresPrivate', 'POST', {'cost': 4.5})
    futuresprivate_post_position_margin_auto_deposit_status = futuresPrivatePostPositionMarginAutoDepositStatus = Entry('position/margin/auto-deposit-status', 'futuresPrivate', 'POST', {'cost': 6})
    futuresprivate_post_margin_withdrawmargin = futuresPrivatePostMarginWithdrawMargin = Entry('margin/withdrawMargin', 'futuresPrivate', 'POST', {'cost': 15})
    futuresprivate_post_position_margin_deposit_margin = futuresPrivatePostPositionMarginDepositMargin = Entry('position/margin/deposit-margin', 'futuresPrivate', 'POST', {'cost': 6})
    futuresprivate_post_position_risk_limit_level_change = futuresPrivatePostPositionRiskLimitLevelChange = Entry('position/risk-limit-level/change', 'futuresPrivate', 'POST', {'cost': 6})
    futuresprivate_post_bullet_private = futuresPrivatePostBulletPrivate = Entry('bullet-private', 'futuresPrivate', 'POST', {'cost': 15})
    futuresprivate_delete_orders_orderid = futuresPrivateDeleteOrdersOrderId = Entry('orders/{orderId}', 'futuresPrivate', 'DELETE', {'cost': 1.5})
    futuresprivate_delete_orders_client_order_clientoid = futuresPrivateDeleteOrdersClientOrderClientOid = Entry('orders/client-order/{clientOid}', 'futuresPrivate', 'DELETE', {'cost': 1.5})
    futuresprivate_delete_orders = futuresPrivateDeleteOrders = Entry('orders', 'futuresPrivate', 'DELETE', {'cost': 45})
    futuresprivate_delete_stoporders = futuresPrivateDeleteStopOrders = Entry('stopOrders', 'futuresPrivate', 'DELETE', {'cost': 22.5})
    webexchange_get_currency_currency_chain_info = webExchangeGetCurrencyCurrencyChainInfo = Entry('currency/currency/chain-info', 'webExchange', 'GET', {'cost': 1})
    broker_get_broker_nd_info = brokerGetBrokerNdInfo = Entry('broker/nd/info', 'broker', 'GET', {'cost': 2})
    broker_get_broker_nd_account = brokerGetBrokerNdAccount = Entry('broker/nd/account', 'broker', 'GET', {'cost': 2})
    broker_get_broker_nd_account_apikey = brokerGetBrokerNdAccountApikey = Entry('broker/nd/account/apikey', 'broker', 'GET', {'cost': 2})
    broker_get_broker_nd_rebase_download = brokerGetBrokerNdRebaseDownload = Entry('broker/nd/rebase/download', 'broker', 'GET', {'cost': 3})
    broker_get_broker_nd_transfer_detail = brokerGetBrokerNdTransferDetail = Entry('broker/nd/transfer/detail', 'broker', 'GET', {'cost': 1})
    broker_get_broker_nd_deposit_detail = brokerGetBrokerNdDepositDetail = Entry('broker/nd/deposit/detail', 'broker', 'GET', {'cost': 1})
    broker_get_broker_nd_withdraw_detail = brokerGetBrokerNdWithdrawDetail = Entry('broker/nd/withdraw/detail', 'broker', 'GET', {'cost': 1})
    broker_post_broker_nd_transfer = brokerPostBrokerNdTransfer = Entry('broker/nd/transfer', 'broker', 'POST', {'cost': 1})
    broker_post_broker_nd_account = brokerPostBrokerNdAccount = Entry('broker/nd/account', 'broker', 'POST', {'cost': 3})
    broker_post_broker_nd_account_apikey = brokerPostBrokerNdAccountApikey = Entry('broker/nd/account/apikey', 'broker', 'POST', {'cost': 3})
    broker_post_broker_nd_account_update_apikey = brokerPostBrokerNdAccountUpdateApikey = Entry('broker/nd/account/update-apikey', 'broker', 'POST', {'cost': 3})
    broker_delete_broker_nd_account_apikey = brokerDeleteBrokerNdAccountApikey = Entry('broker/nd/account/apikey', 'broker', 'DELETE', {'cost': 3})
    earn_get_otc_loan_loan = earnGetOtcLoanLoan = Entry('otc-loan/loan', 'earn', 'GET', {'cost': 1})
    earn_get_otc_loan_accounts = earnGetOtcLoanAccounts = Entry('otc-loan/accounts', 'earn', 'GET', {'cost': 1})
    earn_get_earn_redeem_preview = earnGetEarnRedeemPreview = Entry('earn/redeem-preview', 'earn', 'GET', {'cost': 7.5})
    earn_get_earn_saving_products = earnGetEarnSavingProducts = Entry('earn/saving/products', 'earn', 'GET', {'cost': 7.5})
    earn_get_earn_hold_assets = earnGetEarnHoldAssets = Entry('earn/hold-assets', 'earn', 'GET', {'cost': 7.5})
    earn_get_earn_promotion_products = earnGetEarnPromotionProducts = Entry('earn/promotion/products', 'earn', 'GET', {'cost': 7.5})
    earn_get_earn_kcs_staking_products = earnGetEarnKcsStakingProducts = Entry('earn/kcs-staking/products', 'earn', 'GET', {'cost': 7.5})
    earn_get_earn_staking_products = earnGetEarnStakingProducts = Entry('earn/staking/products', 'earn', 'GET', {'cost': 7.5})
    earn_get_earn_eth_staking_products = earnGetEarnEthStakingProducts = Entry('earn/eth-staking/products', 'earn', 'GET', {'cost': 7.5})
    earn_post_earn_orders = earnPostEarnOrders = Entry('earn/orders', 'earn', 'POST', {'cost': 7.5})
    earn_delete_earn_orders = earnDeleteEarnOrders = Entry('earn/orders', 'earn', 'DELETE', {'cost': 7.5})
