<?php

namespace Binance;

use Binance\BEP20;
use Binance\Bnb;
use Binance\NodeApi;
use Binance\Wallet;

class Helper
{
    private const BSC_MAINNET_URI = 'https://bsc-dataseed.binance.org/';
    private const USDT_CONTRACT_ADDRESS = '0x55d398326f99059fF775485246999027B3197955';
    private const DECIMALS = 18;

    private NodeApi $api;
    private Bnb $bnb;
    private BEP20 $bep20;

    public function __construct(bool $isTestnet = false)
    {
        $uri = $isTestnet ? 'https://data-seed-prebsc-1-s1.binance.org:8545/' : self::BSC_MAINNET_URI;
        $this->api = new NodeApi($uri);
        $this->bnb = new Bnb($this->api);
        $this->initializeBEP20();
    }

    private function initializeBEP20(): void
    {
        $config = [
            'contract_address' => self::USDT_CONTRACT_ADDRESS,
            'decimals' => self::DECIMALS,
        ];
        $this->bep20 = new BEP20($this->api, $config);
    }

    public function getBnbBalance(string $address): string
    {
        return $this->bnb->bnbBalance($address);
    }

    public function getBEP20Balance(string $address): string
    {
        return $this->bep20->balance($address);
    }

    public function transferBnb(string $fromPrivateKey, string $toAddress, float $amount): array
    {
        return $this->bnb->transfer($fromPrivateKey, $toAddress, $amount);
    }

    public function transferBEP20(string $fromPrivateKey, string $toAddress, float $amount): array
    {
        return $this->bep20->transfer($fromPrivateKey, $toAddress, $amount);
    }

    public function generateNewAccount(): array
    {
        return (new Wallet())->newAccountByMnemonic();
    }

    public function revertAccountByMnemonic(string $mnemonic): array
    {
        return (new Wallet())->revertAccountByMnemonic($mnemonic);
    }
}

// Example Usage
/*
$binance = new BinanceHelper();

// Generate new account
$newAccount = $binance->generateNewAccount();

// Get balances
$bnbBalance = $binance->getBnbBalance('0x3152a357d3df06432329f411bba86edf548d1d58');
$usdtBalance = $binance->getBEP20Balance('0x3152a357d3df06432329f411bba86edf548d1d58');

// Perform transfer
// $transferResult = $binance->transferBEP20(
//     '08fccd4ea9bd0d55c8a7754515a5bc37e00b0e79bb0dbea85016aff44e1bd103',
//     '0x61e658a075d985f5a03adf1b5475e093c2b97ec9',
//     5
// );
*/