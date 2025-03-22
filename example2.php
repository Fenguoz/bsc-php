<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Binance\Wallet;

$wallet = new Wallet();

// echo 'Generate mnemonic and create an account: <br><pre>';
// $account = $wallet->newAccountByMnemonic();
// var_dump($account);
// echo '<br>';

// Restore account using mnemonic
// $mnemonic = 'erupt album one document lawsuit rely blouse select tank before banner south';
// $account = $wallet->revertAccountByMnemonic($mnemonic);

// Get the address according to the private key
// $privateKey = '08fccd4ea9bd0d55c8a7754515a1bc37e00b0e79bb0dbea85016aff44e1bd103';
// $account = $wallet->revertAccountByPrivateKey($privateKey);


/**
 * Bnb & BEP20
 */
## Method 1 : BSC RPC Nodes
$uri = 'https://bsc-dataseed.binance.org/'; // Mainnet
// $uri = 'https://data-seed-prebsc-1-s1.binance.org:8545/';// Testnet
$api = new \Binance\NodeApi($uri);
$bnb = new \Binance\Bnb($api);

$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955', // USDT BEP20
    'decimals' => 18,
];

$bep20 = new \Binance\BEP20($api, $config);

// *Check balances
// echo '<br>';
// echo 'wallet USDT balance of "0x3152a357d3df06432329f411bba86edf548d1d58":<br>';
// $address = '0x3152a357d3df06432329f411bba86edf548d1d58';
// $a = $bep20->balance($address);
// var_dump($a);

echo '<br>';
echo '<br><pre>';

// echo 'wallet BNB balance of "0x3152a357d3df06432329f411bba86edf548d1d58":<br>';
// $address = '0x3152a357d3df06432329f411bba86edf548d1d58';
// $a = $bnb->bnbBalance($address);
// var_dump($a);




// / Transaction transfer (offline signature)
$from = '08fccd4ea9bd0d55c8a7754515a5bc37e00b1e71bb0dbea85016aff44e1bd103';
$to = '0x61e658a075d985f5a03adf1b5475e093c2b97ec9';
// $amount = 5;
// // $bnb->transfer($from, $to, $amount);
// $a = $bep20->transfer($from, $to, $amount);

// var_dump($a);

// // Query the latest block
// $bnb->blockNumber();
// $bep20->blockNumber();

// // Query information according to the blockchain
// $blockID = 24631027;
// $bnb->getBlockByNumber($blockID);
// $bep20->getBlockByNumber($blockID);

// // Returns the receipt of a transaction by transaction hash
// $txHash = '0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b';
// $bnb->getTransactionReceipt($txHash);
// $bep20->getTransactionReceipt($txHash);

// // Returns the information about a transaction requested by transaction hash
// $txHash = '0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b';
// $bnb->getTransactionByHash($txHash);
// $bep20->getTransactionByHash($txHash);

// // Query transaction status based on transaction hash
// $txHash = '0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b';
// $bnb->receiptStatus($txHash);
// $bep20->receiptStatus($txHash);