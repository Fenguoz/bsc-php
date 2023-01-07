<?php

class Binance {

    protected $config = [
        'network' => 'mainnet',
        'api_type' => 'bscscan',
        'api_key' => 'QVG2GK41ASNSD21KJTXUAQ4JTRQ4XUQZCX',
    ];

    public function __construct($config = [])
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }
}