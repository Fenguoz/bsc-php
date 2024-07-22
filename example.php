<?php
include './vendor/autoload.php';

// Wallet
$wallet = new \Binance\Wallet();
$addressData = $wallet->newAccountByPrivateKey();

// Bnb & BEP20
# Method 1 : BSC RPC Nodes
$uri = 'https://bsc-dataseed1.defibit.io/'; // Mainnet
// $uri = 'https://data-seed-prebsc-1-s1.binance.org:8545/';// Testnet
$api = new \Binance\NodeApi($uri);

# Method 2 : Bscscan Api
$apiKey = 'QVG2GK41ASNSD21KJTXUAQ4JTRQ4XUQZCX';
$api = new \Binance\BscscanApi($apiKey);

$address = '0x685B1ded8013785d6623CC18D214320b6Bb64759';
$bnbWallet = new \Binance\Bnb($api);
$bnbBalance = $bnbWallet->bnbBalance($address);

$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955', // USDT BEP20
    'decimals' => 18,
];
$bep20Wallet = new \Binance\BEP20($api, $config);
$bep20Balance = $bep20Wallet->balance($address);


#Send Bep20 Tokens From Custom Token

$from = REPLACE_WITH_ADDRESS_PRIVATE_KEY;
$to = '0xc33823b5407d2EC45e3DA8B937651bE1A80F55F5';
$amount = 0.003;
#BNB SEND
$txnHash = $bnb->transfer($from, $to, $amount);
$amount = 100;
#BEP20 SEND
$txnHash = $bep20->transfer($from, $to, $amount);
