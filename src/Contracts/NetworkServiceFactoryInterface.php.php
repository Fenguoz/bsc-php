<?php

namespace Binance\Contracts;

use Binance\Bnb;
use Binance\BEP20;

interface NetworkServiceFactoryInterface
{
    public function getBnbService(): Bnb;
    
    public function getBEP20Service(
        string $contractAddress, 
        int $decimals
    ): BEP20;
}