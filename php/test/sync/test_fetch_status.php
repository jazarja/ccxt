<?php
namespace ccxt;
use \ccxt\Precise;

// ----------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -----------------------------------------------------------------------------
include_once __DIR__ . '/../base/test_status.php';

function test_fetch_status($exchange, $skipped_properties) {
    $method = 'fetchStatus';
    $status = $exchange->fetch_status();
    test_status($exchange, $skipped_properties, $method, $status, $exchange->milliseconds());
}
