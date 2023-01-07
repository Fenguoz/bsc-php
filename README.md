English | [中文](./README-CN.md)

<h1 align="center">BSC-PHP</h1>

## Introduction

Support Binance's BNB and BEP20, which include functions such as address creation, balance query, transaction transfer, query the latest blockchain, query information based on the blockchain, and query information based on the transaction hash.

## Advantage

1. One set of scripts is compatible with all BNB currencies and BEP20 certifications in the BSC network
1. Interface methods can be added or subtracted flexibly

## Support Method

### wallet
- Generate a private key to create an account `newAccountByPrivateKey()`
- Generate mnemonic and create an account `newAccountByMnemonic()`
- Restore account using mnemonic `revertAccountByMnemonic(string $mnemonic)`
- Get the address according to the private key `revertAccountByPrivateKey(string $privateKey)`

### Bnb & BEP20
- Check balances(BNB) `bnbBalance(string $address)`
- Check balances(BEP20) `balance(string $address)`
- Transaction transfer (offline signature) `transfer(string $from, string $to, float $amount)`
- Query the latest block `blockNumber()`
- Query information according to the blockchain `blockByNumber(int $blockID)`
- Query information based on transaction hash `transactionReceipt(string $txHash)`

## Quick Start

### Install

``` php
composer require fenguoz/bsc-php
```

### Interface

#### Wallet
``` php
// Generate a private key to create an account
$wallet = new \Binance\Wallet();
$addressData = $wallet->newAccountByPrivateKey();
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

$address = '0x685B1ded8013785....';
// Bnb - Check balances
$bnbWallet = new \Binance\Bnb($api);
$bnbBalance = $bnbWallet->bnbBalance($address);

// BEP20 - Check balances
$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955',// USDT BEP20
    'decimals' => 18,
];
$bep20Wallet = new \Binance\BEP20($api, $config);
$bep20Balance = $bep20Wallet->balance($address);
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
