<?php
require './vendor/autoload.php';

/**
 * Wallet Operations
 */
$wallet = new \Binance\Wallet();

// Generate new accounts
$privateKeyAccount = $wallet->newAccountByPrivateKey();
$mnemonicAccount = $wallet->newAccountByMnemonic();

// Restore accounts
$restoredAccount = $wallet->revertAccountByMnemonic('elite link code extra....');
$addressFromPK = $wallet->revertAccountByPrivateKey('5e9340935f4c02****f56563b8dffab368');

/**
 * Blockchain Services Setup
 */
// Initialize network with Node API
$nodeApi = new \Binance\NodeApi('https://bsc-dataseed1.defibit.io/');
$network = new \Binance\Network($nodeApi);

// Get services
$bnbService = $network->getBnbService();
$usdtService = $network->getBEP20Service(
    '0x55d398326f99059fF775485246999027B3197955',
    18
);

/**
 * Balance Checks
 */
$address = '0x1667ca2c7****021be3a';
$bnbBalance = $bnbService->bnbBalance($address);
$usdtBalance = $usdtService->balance($address);

/**
 * Transaction Operations
 */
$txHash = $usdtService->transfer(
    'sender_private_key_hex',
    '0xd8699f0****b60eef021',
    0.1
);

/**
 * Blockchain Queries
 */
$latestBlock = $bnbService->blockNumber();
$blockData = $usdtService->getBlockByNumber(24631027);
$txReceipt = $bnbService->getTransactionReceipt('0x4dd20d01af4c621d2f****77988bfb245a18bfb6f50604b');