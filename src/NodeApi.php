<?php

namespace Binance;

class NodeApi implements ProxyApi
{
    protected $server;
    protected $user;
    protected $password;
    protected $network;

    function __construct(string $server, string $user = null, string $password = null, string $network = 'mainnet')
    {
        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->network = $network;
    }

    public function send($method, $params = [])
    {
        $url = $this->server;

        $strParams = json_encode(array_values($params));
        $data_string = <<<data
{"jsonrpc":"2.0","method":"{$method}","params": $strParams,"id":1}
data;

        $data = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => $data_string
        ];
        if ($this->user && $this->password) {
            $data['auth'] = [
                $this->user,
                $this->password
            ];
        }

        $res = Utils::httpRequest('POST', $url, $data);
        if (isset($res['result'])) {
            return $res['result'];
        } else {
            return false;
        }
    }

    function gasPrice()
    {
        return $this->send('eth_gasPrice');
    }

    function bnbBalance(string $address)
    {
        $balance = $this->send('eth_getBalance', ['address' => $address, 'latest']);
        return Utils::toDisplayAmount($balance, 18);
    }

    function receiptStatus(string $txHash): bool
    {
        $res = $this->send('eth_getTransactionReceipt', ['txHash' => $txHash]);
        return hexdec($res['status']) ? true : false;
    }

    function sendRawTransaction($raw)
    {
        return $this->send('eth_sendRawTransaction', ['hex' => $raw]);
    }

    function getNonce(string $address)
    {
        return $this->send('eth_getTransactionCount', ['address' => $address, 'latest']);
    }

    function getTransactionReceipt(string $txHash)
    {
        return $this->send('eth_getTransactionReceipt', ['txHash' => $txHash]);
    }

    function getTransactionByHash(string $txHash)
    {
        return $this->send('eth_getTransactionByHash', ['txHash' => $txHash]);
    }

    function getNetwork(): string
    {
        return $this->network;
    }

    function ethCall($params): string
    {
        return $this->send('eth_call', ['params' => $params, 'latest']);
    }

    function blockNumber()
    {
        return hexdec($this->send('eth_blockNumber'));
    }

    function getBlockByNumber(int $blockNumber)
    {
        $blockNumber = Utils::toHex($blockNumber, true);
        return $this->send('eth_getBlockByNumber', ['blockNumber' => $blockNumber, true]);
    }
}
