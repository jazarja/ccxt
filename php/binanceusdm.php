<?php

namespace ccxt;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\abstract\binanceusdm as binance;

class binanceusdm extends binance {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'id' => 'binanceusdm',
            'name' => 'Binance USDⓈ-M',
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/1294454/117738721-668c8d80-b205-11eb-8c49-3fad84c4a07f.jpg',
                'doc' => array(
                    'https://binance-docs.github.io/apidocs/futures/en/',
                    'https://binance-docs.github.io/apidocs/spot/en',
                ),
            ),
            'has' => array(
                'CORS' => null,
                'spot' => false,
                'margin' => false,
                'swap' => true,
                'future' => true,
                'option' => null,
                'createStopMarketOrder' => true,
            ),
            'options' => array(
                'fetchMarkets' => array( 'linear' ),
                'defaultSubType' => 'linear',
                // https://www.binance.com/en/support/faq/360033162192
                // tier amount, maintenance margin, initial margin
                'leverageBrackets' => null,
                'marginTypes' => array(),
                'marginModes' => array(),
            ),
            // https://binance-docs.github.io/apidocs/futures/en/#error-codes
            'exceptions' => array(
                'exact' => array(
                    '-5021' => '\\ccxt\\InvalidOrder', // array("code":-5021,"msg":"Due to the order could not be filled immediately, the FOK order has been rejected.")
                    '-5022' => '\\ccxt\\InvalidOrder', // array("code":-5022,"msg":"Due to the order could not be executed, the Post Only order will be rejected.")
                    '-5028' => '\\ccxt\\InvalidOrder', // array("code":-5028,"msg":"Timestamp for this request is outside of the ME recvWindow.")
                ),
            ),
        ));
    }

    public function transfer_in(string $code, $amount, $params = array ()) {
        // transfer from spot wallet to usdm futures wallet
        return $this->futuresTransfer ($code, $amount, 1, $params);
    }

    public function transfer_out(string $code, $amount, $params = array ()) {
        // transfer from usdm futures wallet to spot wallet
        return $this->futuresTransfer ($code, $amount, 2, $params);
    }
}
