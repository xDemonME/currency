<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyHistoricalRates extends CurrencyRates
{
    /**
     * CurrencyHistoricalRates constructor.
     *
     * @param string $date
     * @param Client|null $client
     * @param array $config
     */
    public function __construct(string $date, ?Client $client = null, array $config = [])
    {
        parent::__construct($client, $config);
        $this->base_url = "https://api.exchangerate.host/historical";

        $this->params['date'] = $date;
    }
}