English | [中文](./README-CN.md)

<h1 align="center">BSC-PHP</h1>

<p align="center">
  <a href="https://github.com/Fenguoz/bsc-php/releases"><img src="https://poser.pugx.org/Fenguoz/bsc-php/v/stable" alt="Stable Version"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/php-%3E=7.2-brightgreen.svg?maxAge=2592000" alt="Php Version"></a>
  <a href="https://github.com/Fenguoz/bsc-php/blob/master/LICENSE"><img src="https://img.shields.io/github/license/fenguoz/bsc-php.svg?maxAge=2592000" alt="bsc-php License"></a>
  <a href="https://packagist.org/packages/Fenguoz/bsc-php"><img src="https://poser.pugx.org/Fenguoz/bsc-php/downloads" alt="Total Downloads"></a>
</p>

## Introduction

Support Binance's BNB and BEP20, which include functions such as address creation, balance query, transaction transfer, query the latest blockchain, query information based on the blockchain, and query information based on the transaction hash.

## Advantage

1. One set of scripts is compatible with all BNB currencies and BEP20 certifications in the BSC network
1. Interface methods can be added or subtracted flexibly

## Support Method

### wallet
- *Generate a private key to create an account `newAccountByPrivateKey()`
- *Generate mnemonic and create an account `newAccountByMnemonic()`
- Restore account using mnemonic `revertAccountByMnemonic(string $mnemonic)`
- Get the address according to the private key `revertAccountByPrivateKey(string $privateKey)`

### Bnb & BEP20
- *Check balances(BNB) `bnbBalance(string $address)`
- *Check balances(BEP20) `balance(string $address)`
- Transaction transfer (offline signature) `transfer(string $from, string $to, float $amount)`
- Query the latest block `blockNumber()`
- Query information according to the blockchain `getBlockByNumber(int $blockID)`
- Returns the receipt of a transaction by transaction hash `getTransactionReceipt(string $txHash)`
- *Returns the information about a transaction requested by transaction hash `getTransactionByHash(string $txHash)`
- *Query transaction status based on transaction hash `receiptStatus(string $txHash)`


## Quick Start

### Install

PHP8
``` php
composer require fenguoz/bsc-php
```

or PHP7
``` php
composer require fenguoz/bsc-php ~1.0
```

### Interface

#### Wallet
``` php
$wallet = new \Binance\Wallet();

// Generate a private key to create an account
$wallet->newAccountByPrivateKey();

// Generate mnemonic and create an account
$wallet->newAccountByMnemonic();

// Restore account using mnemonic
$mnemonic = 'elite link code extra twist autumn flower purse excuse harsh kitchen whip';
$wallet->revertAccountByMnemonic($mnemonic);

// Get the address according to the private key
$privateKey = '5e9340935f4c02628cec5d04cc281012537cafa8dae0e27ff56563b8dffab368';
$wallet->revertAccountByPrivateKey($privateKey);
``` 

#### Bnb & BEP20
``` php
## Method 1 : BSC RPC Nodes
$uri = 'https://bsc-dataseed1.defibit.io/';// Mainnet
// $uri = 'https://data-seed-prebsc-1-s1.binance.org:8545/';// Testnet
$api = new \Binance\NodeApi($uri);

## Method 2 : Bscscan Api
$apiKey = 'QVG2GK41ASNSD21KJTXUAQ4JTRQ4XUQZCX';
$api = new \Binance\BscscanApi($apiKey);

$bnb = new \Binance\Bnb($api);

$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955',// USDT BEP20
    'decimals' => 18,
];
$bep20 = new \Binance\BEP20($api, $config);

// *Check balances
$address = '0x1667ca2c72d8699f0c34c55ea00b60eef021be3a';
$bnb->bnbBalance($address);
$bep20->balance($address);

// Transaction transfer (offline signature)
$from = '0x1667ca2c72d8699f0c34c55ea00b60eef021be3a';
$to = '0x1667ca2c72d8699f0c34c55ea00b60eef021****';
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
$txHash = '0x4dd20d01af4c621d2fc293dff17a8fd8403ea3577988bfb245a18bfb6f50604b';
$bnb->getTransactionReceipt($txHash);
$bep20->getTransactionReceipt($txHash);

// Returns the information about a transaction requested by transaction hash
$txHash = '0x4dd20d01af4c621d2fc293dff17a8fd8403ea3577988bfb245a18bfb6f50604b';
$bnb->getTransactionByHash($txHash);
$bep20->getTransactionByHash($txHash);

// Query transaction status based on transaction hash
$txHash = '0x4dd20d01af4c621d2fc293dff17a8fd8403ea3577988bfb245a18bfb6f50604b';
$bnb->receiptStatus($txHash);
$bep20->receiptStatus($txHash);
```

## Plan

- Support ERC721|ERC-1155
- Smart Contract

## 🌟🌟

[![Stargazers over time](https://starchart.cc/Fenguoz/bsc-php.svg)](https://starchart.cc/Fenguoz/bsc-php)

## Cooperate

Contact
- WX：zgf243944672
- QQ：243944672
