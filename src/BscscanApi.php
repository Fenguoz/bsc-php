<?php

namespace Binance;

class BscscanApi implements ProxyApi
{
    protected $apiKey;
    protected $network;

    function __construct(string $apiKey, $network = 'mainnet')
    {
        $this->apiKey = $apiKey;
        $this->network = $network;
    }

    public function send($method, $params = [])
    {
        $defaultParams = [
            'module' => 'proxy',
            'tag' => 'latest',
        ];

        foreach ($defaultParams as $key => $val) {
            if (!isset($params[$key])) {
                $params[$key] = $val;
            }
        }

        $preApi = 'api';
        if ($this->network != 'mainnet') {
            $preApi .= '-' . $this->network;
        }

        $url = "https://$preApi.bscscan.com/api?action={$method}&apikey={$this->apiKey}";
        if ($params && count($params) > 0) {
            $strParams = http_build_query($params);
            $url .= "&{$strParams}";
        }

        $res = Utils::httpRequest('GET', $url);
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
        $params['module'] = 'account';
        $params['address'] = $address;

        $retDiv = Utils::fromWei($this->send('balance', $params), 'ether');
        if (is_array($retDiv)) {
            return Utils::divideDisplay($retDiv, 18);
        } else {
            return $retDiv;
        }
    }

    function receiptStatus(string $txHash): ?bool
    {
        $res = $this->send('eth_getTransactionByHash', ['txhash' => $txHash]);
        if (!$res) {
            return false;
        }

        if (!$res['blockNumber']) {
            return null;
        }

        $params['module'] = 'transaction';
        $params['txhash'] = $txHash;

        $res =  $this->send('gettxreceiptstatus', $params);
        return $res['status'] == '1';
    }

    function getTransactionReceipt(string $txHash)
    {
        $res = $this->send('eth_getTransactionReceipt', ['txhash' => $txHash]);
        return $res;
    }

    function getTransactionByHash(string $txHash)
    {
        return $this->send('eth_getTransactionByHash', ['txHash' => $txHash]);
    }

    function sendRawTransaction($raw)
    {
        return $this->send('eth_sendRawTransaction', ['hex' => $raw]);
    }

    function getNonce(string $address)
    {
        return $this->send('eth_getTransactionCount', ['address' => $address]);
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
