// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

namespace ccxt;

public partial class bitbay : zonda
{
    public bitbay (object args = null): base(args) {}

    public async Task<object> publicGetIdAll (object parameters = null)
    {
        return await this.callAsync ("publicGetIdAll",parameters);
    }

    public async Task<object> publicGetIdMarket (object parameters = null)
    {
        return await this.callAsync ("publicGetIdMarket",parameters);
    }

    public async Task<object> publicGetIdOrderbook (object parameters = null)
    {
        return await this.callAsync ("publicGetIdOrderbook",parameters);
    }

    public async Task<object> publicGetIdTicker (object parameters = null)
    {
        return await this.callAsync ("publicGetIdTicker",parameters);
    }

    public async Task<object> publicGetIdTrades (object parameters = null)
    {
        return await this.callAsync ("publicGetIdTrades",parameters);
    }

    public async Task<object> privatePostInfo (object parameters = null)
    {
        return await this.callAsync ("privatePostInfo",parameters);
    }

    public async Task<object> privatePostTrade (object parameters = null)
    {
        return await this.callAsync ("privatePostTrade",parameters);
    }

    public async Task<object> privatePostCancel (object parameters = null)
    {
        return await this.callAsync ("privatePostCancel",parameters);
    }

    public async Task<object> privatePostOrderbook (object parameters = null)
    {
        return await this.callAsync ("privatePostOrderbook",parameters);
    }

    public async Task<object> privatePostOrders (object parameters = null)
    {
        return await this.callAsync ("privatePostOrders",parameters);
    }

    public async Task<object> privatePostTransfer (object parameters = null)
    {
        return await this.callAsync ("privatePostTransfer",parameters);
    }

    public async Task<object> privatePostWithdraw (object parameters = null)
    {
        return await this.callAsync ("privatePostWithdraw",parameters);
    }

    public async Task<object> privatePostHistory (object parameters = null)
    {
        return await this.callAsync ("privatePostHistory",parameters);
    }

    public async Task<object> privatePostTransactions (object parameters = null)
    {
        return await this.callAsync ("privatePostTransactions",parameters);
    }

    public async Task<object> v1_01PublicGetTradingTicker (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingTicker",parameters);
    }

    public async Task<object> v1_01PublicGetTradingTickerSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingTickerSymbol",parameters);
    }

    public async Task<object> v1_01PublicGetTradingStats (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingStats",parameters);
    }

    public async Task<object> v1_01PublicGetTradingStatsSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingStatsSymbol",parameters);
    }

    public async Task<object> v1_01PublicGetTradingOrderbookSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingOrderbookSymbol",parameters);
    }

    public async Task<object> v1_01PublicGetTradingTransactionsSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingTransactionsSymbol",parameters);
    }

    public async Task<object> v1_01PublicGetTradingCandleHistorySymbolResolution (object parameters = null)
    {
        return await this.callAsync ("v1_01PublicGetTradingCandleHistorySymbolResolution",parameters);
    }

    public async Task<object> v1_01PrivateGetApiPaymentsDepositsCryptoAddresses (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetApiPaymentsDepositsCryptoAddresses",parameters);
    }

    public async Task<object> v1_01PrivateGetPaymentsWithdrawalDetailId (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetPaymentsWithdrawalDetailId",parameters);
    }

    public async Task<object> v1_01PrivateGetPaymentsDepositDetailId (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetPaymentsDepositDetailId",parameters);
    }

    public async Task<object> v1_01PrivateGetTradingOffer (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetTradingOffer",parameters);
    }

    public async Task<object> v1_01PrivateGetTradingStopOffer (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetTradingStopOffer",parameters);
    }

    public async Task<object> v1_01PrivateGetTradingConfigSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetTradingConfigSymbol",parameters);
    }

    public async Task<object> v1_01PrivateGetTradingHistoryTransactions (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetTradingHistoryTransactions",parameters);
    }

    public async Task<object> v1_01PrivateGetBalancesBITBAYHistory (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetBalancesBITBAYHistory",parameters);
    }

    public async Task<object> v1_01PrivateGetBalancesBITBAYBalance (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetBalancesBITBAYBalance",parameters);
    }

    public async Task<object> v1_01PrivateGetFiatCantorRateBaseIdQuoteId (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetFiatCantorRateBaseIdQuoteId",parameters);
    }

    public async Task<object> v1_01PrivateGetFiatCantorHistory (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetFiatCantorHistory",parameters);
    }

    public async Task<object> v1_01PrivateGetClientPaymentsV2CustomerCryptoCurrencyChannelsDeposit (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetClientPaymentsV2CustomerCryptoCurrencyChannelsDeposit",parameters);
    }

    public async Task<object> v1_01PrivateGetClientPaymentsV2CustomerCryptoCurrencyChannelsWithdrawal (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetClientPaymentsV2CustomerCryptoCurrencyChannelsWithdrawal",parameters);
    }

    public async Task<object> v1_01PrivateGetClientPaymentsV2CustomerCryptoDepositFee (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetClientPaymentsV2CustomerCryptoDepositFee",parameters);
    }

    public async Task<object> v1_01PrivateGetClientPaymentsV2CustomerCryptoWithdrawalFee (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateGetClientPaymentsV2CustomerCryptoWithdrawalFee",parameters);
    }

    public async Task<object> v1_01PrivatePostTradingOfferSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostTradingOfferSymbol",parameters);
    }

    public async Task<object> v1_01PrivatePostTradingStopOfferSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostTradingStopOfferSymbol",parameters);
    }

    public async Task<object> v1_01PrivatePostTradingConfigSymbol (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostTradingConfigSymbol",parameters);
    }

    public async Task<object> v1_01PrivatePostBalancesBITBAYBalance (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostBalancesBITBAYBalance",parameters);
    }

    public async Task<object> v1_01PrivatePostBalancesBITBAYBalanceTransferSourceDestination (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostBalancesBITBAYBalanceTransferSourceDestination",parameters);
    }

    public async Task<object> v1_01PrivatePostFiatCantorExchange (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostFiatCantorExchange",parameters);
    }

    public async Task<object> v1_01PrivatePostApiPaymentsWithdrawalsCrypto (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostApiPaymentsWithdrawalsCrypto",parameters);
    }

    public async Task<object> v1_01PrivatePostApiPaymentsWithdrawalsFiat (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostApiPaymentsWithdrawalsFiat",parameters);
    }

    public async Task<object> v1_01PrivatePostClientPaymentsV2CustomerCryptoDeposit (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostClientPaymentsV2CustomerCryptoDeposit",parameters);
    }

    public async Task<object> v1_01PrivatePostClientPaymentsV2CustomerCryptoWithdrawal (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePostClientPaymentsV2CustomerCryptoWithdrawal",parameters);
    }

    public async Task<object> v1_01PrivateDeleteTradingOfferSymbolIdSidePrice (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateDeleteTradingOfferSymbolIdSidePrice",parameters);
    }

    public async Task<object> v1_01PrivateDeleteTradingStopOfferSymbolIdSidePrice (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivateDeleteTradingStopOfferSymbolIdSidePrice",parameters);
    }

    public async Task<object> v1_01PrivatePutBalancesBITBAYBalanceId (object parameters = null)
    {
        return await this.callAsync ("v1_01PrivatePutBalancesBITBAYBalanceId",parameters);
    }

}