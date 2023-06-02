[English](./README.md) | 中文

<h1 align="center">BSC-PHP</h1>

<p align="center">
  <a href="https://github.com/Fenguoz/bsc-php/releases"><img src="https://poser.pugx.org/Fenguoz/bsc-php/v/stable" alt="Stable Version"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/php-%3E=7.2-brightgreen.svg?maxAge=2592000" alt="Php Version"></a>
  <a href="https://github.com/Fenguoz/bsc-php/blob/master/LICENSE"><img src="https://img.shields.io/github/license/fenguoz/bsc-php.svg?maxAge=2592000" alt="bsc-php License"></a>
  <a href="https://packagist.org/packages/Fenguoz/bsc-php"><img src="https://poser.pugx.org/Fenguoz/bsc-php/downloads" alt="Total Downloads"></a>
</p>

## 概述

BSC-PHP 目前支持币安智能链的 BNB 和 BEP20 数字资产常用的生成地址，发起转账，查询余额，离线签名等功能。

## 特点

1. 一套写法兼容 TRON 网络中 TRX 货币和 TRC 系列所有通证
1. 接口方法可可灵活增减

## 支持方法

### wallet
- *生成私钥创建账户 `newAccountByPrivateKey()`
- *生成助记词创建账户 `newAccountByMnemonic()`
- 使用助记词还原账户 `revertAccountByMnemonic(string $mnemonic)`
- 根据私钥得到地址 `revertAccountByPrivateKey(string $privateKey)`

### Bnb & BEP20
- *查询余额(BNB) `bnbBalance(string $address)`
- *查询余额(BEP20) `balance(string $address)`
- *交易转账(离线签名) `transfer(string $from, string $to, float $amount)`
- 查询最新区块 `blockNumber()`
- 根据区块链查询信息 `getBlockByNumber(int $blockID)`
- 根据交易哈希返回交易的收据 `getTransactionReceipt(string $txHash)`
- *根据交易哈希返回关于所请求交易的信息 `getTransactionByHash(string $txHash)`
- *根据交易哈希查询交易状态 `receiptStatus(string $txHash)`

## 快速开始

### 安装

PHP8
``` php
composer require fenguoz/bsc-php
```

or PHP7
``` php
composer require fenguoz/bsc-php ~1.0
```

### 接口调用

#### Wallet
``` php
$wallet = new \Binance\Wallet();

// 生成私钥创建账户
$wallet->newAccountByPrivateKey();

// 生成助记词创建账户
$wallet->newAccountByMnemonic();

// 使用助记词还原账户
$mnemonic = 'elite link code extra twist autumn flower purse excuse harsh kitchen whip';
$wallet->revertAccountByMnemonic($mnemonic);

// 根据私钥得到地址
$privateKey = '5e9340935f4c02628cec5d04cc281012537cafa8dae0e27ff56563b8dffab368';
$wallet->revertAccountByPrivateKey($privateKey);
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

$bnb = new \Binance\Bnb($api);

$config = [
    'contract_address' => '0x55d398326f99059fF775485246999027B3197955',// USDT BEP20
    'decimals' => 18,
];
$bep20 = new \Binance\BEP20($api, $config);

// 查询余额
$address = '0x1667ca2c72d8699f0c34c55ea00b60eef021be3a';
$bnb->bnbBalance($address);
$bep20->balance($address);

// 交易转账(离线签名)
$from = '0x1667ca2c72d8699f0c34c55ea00b60eef021be3a';
$to = '0x1667ca2c72d8699f0c34c55ea00b60eef021****';
$amount = 0.1;
$bnb->transfer($from, $to, $amount);
$bep20->transfer($from, $to, $amount);

// 查询最新区块
$bnb->blockNumber();
$bep20->blockNumber();

// 根据区块链查询信息
$blockID = 24631027;
$bnb->getBlockByNumber($blockID);
$bep20->getBlockByNumber($blockID);

// 根据交易哈希返回交易的收据
$txHash = '0x4dd20d01af4c621d2fc293dff17a8fd8403ea3577988bfb245a18bfb6f50604b';
$bnb->getTransactionReceipt($txHash);
$bep20->getTransactionReceipt($txHash);

// 根据交易哈希返回关于所请求交易的信息
$txHash = '0x4dd20d01af4c621d2fc293dff17a8fd8403ea3577988bfb245a18bfb6f50604b';
$bnb->getTransactionByHash($txHash);
$bep20->getTransactionByHash($txHash);

// 根据交易哈希查询交易状态
$txHash = '0x4dd20d01af4c621d2fc293dff17a8fd8403ea3577988bfb245a18bfb6f50604b';
$bnb->receiptStatus($txHash);
$bep20->receiptStatus($txHash);
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
