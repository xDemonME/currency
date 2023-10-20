<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyLatestRates extends CurrencyRates
{
    /**
     * CurrencyLatestRates constructor.
     *
     * @param Client|null $client
     * @param array $config
     */
    public function __construct(?Client $client = null, array $config = [])
    {
        parent::__construct($client, $config);
        $this->base_url = "https://api.exchangerate.host/latest";
    }
}