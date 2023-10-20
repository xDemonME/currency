<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyFactory
{
    /**
     * @param Client|null $client
     * @param array $config
     * @return CurrencyConversion
     */
    public function convert(?Client $client = null, array $config = [])
    {
        return new CurrencyConversion($client, $config);
    }

    /**
     *
     * @return CurrencyRatesProxy
     */
    public function rates()
    {
        return new CurrencyRatesProxy();
    }
}