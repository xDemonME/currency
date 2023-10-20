<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyRatesProxy
{
    /**
     * @param Client|null $client
     * @param array $config
     * @return CurrencyLatestRates
     */
    public function latest(?Client $client = null, array $config = [])
    {
        return new CurrencyLatestRates($client, $config);
    }

    /**
     * @param string $date
     * @param Client|null $client
     * @param array $config
     * @return CurrencyHistoricalRates
     */
    public function historical(string $date, ?Client $client = null, array $config = [])
    {
        return new CurrencyHistoricalRates($date, $client, $config);
    }

    /**
     * @param string $date_from
     * @param string $date_to
     * @param Client|null $client
     * @param array $config
     * @return CurrencyTimeSeriesRates
     */
    public function timeSeries(string $date_from, string $date_to, ?Client $client = null, array $config = [])
    {
        return new CurrencyTimeSeriesRates($date_from, $date_to, $client, $config);
    }

    /**
     * @param string $date_from
     * @param string $date_to
     * @param Client|null $client
     * @param array $config
     * @return CurrencyFluctuations
     */
    public function fluctuations(string $date_from, string $date_to, ?Client $client = null, array $config = [])
    {
        return new CurrencyFluctuations($date_from, $date_to, $client, $config);
    }
}