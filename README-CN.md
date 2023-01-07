[English](./README.md) | 中文

<h1 align="center">BSC-PHP</h1>

## 概述

BSC-PHP 目前支持币安智能链的 BNB 和 BEP20 数字资产常用的生成地址，发起转账，查询余额，离线签名等功能。

## 特点

1. 一套写法兼容 TRON 网络中 TRX 货币和 TRC 系列所有通证
1. 接口方法可可灵活增减

## 支持方法

### wallet
- 生成私钥创建账户 `newAccountByPrivateKey()`
- 生成助记词创建账户 `newAccountByMnemonic()`
- 使用助记词还原账户 `revertAccountByMnemonic(string $mnemonic)`
- 根据私钥得到地址 `revertAccountByPrivateKey(string $privateKey)`

### Bnb & BEP20
- 查询余额(BNB) `bnbBalance(string $address)`
- 查询余额(BEP20) `balance(string $address)`
- 交易转账(离线签名) `transfer(string $from, string $to, float $amount)`
- 查询最新区块 `blockNumber()`
- 根据区块链查询信息 `blockByNumber(int $blockID)`
- 根据交易哈希查询信息 `transactionReceipt(string $txHash)`

## 快速开始

### 安装

``` php
composer require fenguoz/bsc-php
```

### 接口调用

#### Wallet
``` php
// 生成私钥创建账户
$wallet = new \Binance\Wallet();
$addressData = $wallet->newAccountByPrivateKey();
``` 

#### Bnb & BEP20
``` php
## 方法 1 : BSC RPC Nodes
$uri = 'https://bsc-dataseed1.defibit.io/';// Mainnet
// $uri = 'https://data-seed-prebsc-1-s1.binance.org:8545/';// Testnet
$api = new \Binance\NodeApi($uri);

## 方法 2 : Bscscan Api
$apiKey = 'QVG2GK41ASNSD21KJTXUAQ4JTRQ4XUQZCX';
$api = new \Binance\BscscanApi($apiKey);

$address = '0x685B1ded8013785....';
// Bnb查询余额
$bnbWallet = new \Binance\Bnb($api);
$bnbBalance = $bnbWallet->bnbBalance($address);

// BEP20查询余额
$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955',// USDT BEP20
    'decimals' => 18,
];
$bep20Wallet = new \Binance\BEP20($api, $config);
$bep20Balance = $bep20Wallet->balance($address);
```

## 计划

- 支持 ERC721|ERC-1155
- 智能合约

## 🌟🌟

[![Stargazers over time](https://starchart.cc/Fenguoz/bsc-php.svg)](https://starchart.cc/Fenguoz/bsc-php)

## 合作

联系方式
- WX：zgf243944672
- QQ：243944672
