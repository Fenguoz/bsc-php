<?php

namespace Binance;

use InvalidArgumentException;
use Binance\Contracts\NetworkServiceFactoryInterface;
use Binance\Utils;
use Binance\BEP20;
use Binance\Bnb;

/**
 * Network service factory for managing blockchain interactions
 * 
 * Provides centralized access to BNB and BEP20 services with validation
 * Implements NetworkServiceFactoryInterface for standardized service creation
 */
class Network implements NetworkServiceFactoryInterface
{
    /** @var ProxyApi $api Blockchain API connector instance */
    private ProxyApi $api;

    /**
     * Initialize network with API connector
     * @param ProxyApi $api Configured API instance (NodeApi/BscscanApi)
     */
    public function __construct(ProxyApi $api)
    {
        $this->api = $api;
    }

    /**
     * Get BNB service instance
     * @return Bnb Configured BNB service
     */
    public function getBnbService(): Bnb
    {
        return new Bnb($this->api);
    }

    /**
     * Get BEP20 service instance with contract validation
     * @param string $contractAddress Valid BEP20 contract address
     * @param int $decimals Token decimals (1-18)
     * @return BEP20 Configured BEP20 service
     * @throws InvalidArgumentException For invalid parameters
     */
    public function getBEP20Service(string $contractAddress, int $decimals): BEP20
    {
        if (!Utils::isAddress($contractAddress)) {
            throw new InvalidArgumentException('Invalid contract address');
        }
        
        if ($decimals <= 0 || $decimals > 18) {
            throw new InvalidArgumentException('Decimals must be between 1-18');
        }
    
        return new BEP20($this->api, [
            'contract_address' => $contractAddress,
            'decimals' => $decimals
        ]);
    }
}