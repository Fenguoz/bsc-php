<?php
include './vendor/autoload.php';
/**
 * Wallet
 */
$wallet = new \Binance\Wallet();

// Generate a private key to create an account
$wallet->newAccountByPrivateKey();

// Generate mnemonic and create an account
$wallet->newAccountByMnemonic();

// Restore account using mnemonic
$mnemonic = 'elite link code extra....';
$wallet->revertAccountByMnemonic($mnemonic);

// Get the address according to the private key
$privateKey = '5e9340935f4c02****f56563b8dffab368';
$wallet->revertAccountByPrivateKey($privateKey);

/**
 * Bnb & BEP20
 */
## Method 1 : BSC RPC Nodes
$uri = 'https://bsc-dataseed1.binance.org'; // Mainnet
$api = new \Binance\NodeApi($uri);
// $uri = 'https://data-seed-prebsc-1-s1.binance.org:8545/';// Testnet
// $api = new \Binance\NodeApi($uri, null, null, 'testnet');

## Method 2 : Bscscan Api
$apiKey = 'QVG2GK41A****RQ4XUQZCX';
$api = new \Binance\BscscanApi($apiKey);

$bnb = new \Binance\Bnb($api);

$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955', // USDT BEP20
    'decimals' => 18,
];
$bep20 = new \Binance\BEP20($api, $config);

// *Check balances
$address = '0x1667ca2c7****021be3a';
$bnb->bnbBalance($address);
$bep20->balance($address);

// Transaction transfer (offline signature)
$from = '0x1667ca2c7****021be3a';
$to = '0xd8699f0****b60eef021';
$amount = 0.1;
$bnb->transfer($from, $to, $amount);
$bep20->transfer($from, $to, $amount);

// Query the latest block
$bnb->blockNumber();
$bep20->blockNumber();

// Query information according to the blockchain
$blockID = 24631027;
$bnb->getBlockByNumber($blockID);
$bep20->getBlockByNumber($blockID);

// Returns the receipt of a transaction by transaction hash
$txHash = '0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b';
$bnb->getTransactionReceipt($txHash);
$bep20->getTransactionReceipt($txHash);

// Returns the information about a transaction requested by transaction hash
$txHash = '0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b';
$bnb->getTransactionByHash($txHash);
$bep20->getTransactionByHash($txHash);

// Query transaction status based on transaction hash
$txHash = '0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b';
$bnb->receiptStatus($txHash);
$bep20->receiptStatus($txHash);
