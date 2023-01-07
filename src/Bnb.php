<?php

namespace Binance;

use Web3p\EthereumTx\Transaction;

class Bnb
{
    protected $proxyApi;

    function __construct(ProxyApi $proxyApi)
    {
        $this->proxyApi = $proxyApi;
    }

    function __call($name, $arguments)
    {
        return call_user_func_array([$this->proxyApi, $name], $arguments);
    }

    // type:[standard|fast|rapid]
    public static function gasPriceOracle($type = 'standard')
    {
        $url = 'https://gbsc.blockscan.com/gasapi.ashx?apikey=key&method=pendingpooltxgweidata';
        $res = Utils::httpRequest('GET', $url);
        if ($type && isset($res['result'][$type . 'gaspricegwei'])) {
            $price = Utils::toWei((string)$res['result'][$type . 'gaspricegwei'], 'gwei');
            //            $price = $price * 1e9;
            return $price;
        } else {
            return $res;
        }
    }

    public static function getChainId($network): int
    {
        $chainId = 56;
        switch ($network) {
            case 'mainnet':
                $chainId = 56;
                break;
            case 'testnet':
                $chainId = 97;
                break;
            default:
                break;
        }

        return $chainId;
    }

    public function transfer(string $privateKey, string $to, float $value, string $gasPrice = 'standard')
    {
        $from = PEMHelper::privateKeyToAddress($privateKey);
        $nonce = $this->proxyApi->getNonce($from);
        if (!Utils::isHex($gasPrice)) {
            $gasPrice = Utils::toHex(self::gasPriceOracle($gasPrice), true);
        }

        $eth = Utils::toWei("$value", 'ether');
        //        $eth = $value * 1e16;
        $eth = Utils::toHex($eth, true);

        $transaction = new Transaction([
            'nonce' => "$nonce",
            'from' => $from,
            'to' => $to,
            'gas' => '0x76c0',
            'gasPrice' => "$gasPrice",
            'value' => "$eth",
            'chainId' => self::getChainId($this->proxyApi->getNetwork()),
        ]);

        $raw = $transaction->sign($privateKey);
        $res = $this->proxyApi->sendRawTransaction('0x' . $raw);
        return $res;
    }
}
