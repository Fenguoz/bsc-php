<?php

namespace Binance;

interface ProxyApi
{

    function getNetwork(): string;

    function send($method, $params = []);

    function gasPrice();

    function bnbBalance(string $address);

    function receiptStatus(string $txHash): ?bool;

    function getTransactionReceipt(string $txHash);

    function getTransactionByHash(string $txHash);

    function sendRawTransaction($raw);

    function getNonce(string $address);

    function ethCall($params);

    function blockNumber();

    function getBlockByNumber(int $blockNumber);
}
