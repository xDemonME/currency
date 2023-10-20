<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyRatesProxy
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param string $access_key
     * @return CurrencyRatesProxy
     */
    public function setAccessKey(string $access_key)
    {
        $this->config['access_key'] = $access_key;

        return $this;
    }

    /**
     * @param Client|null $client
     * @return CurrencyLiveRates
     */
    public function live(?Client $client = null)
    {
        return new CurrencyLiveRates($client, $this->config);
    }

    /**
     * @param Client|null $client
     * @return CurrencyLiveRates
     * @deprecated
     */
    public function latest(?Client $client = null)
    {
        return $this->live($client);
    }

    /**
     * @param string $date
     * @param Client|null $client
     * @return CurrencyHistoricalRates
     */
    public function historical(string $date, ?Client $client = null)
    {
        return new CurrencyHistoricalRates($date, $client, $this->config);
    }

    /**
     * @param string $date_from
     * @param string $date_to
     * @param Client|null $client
     * @return CurrencyTimeFrameRates
     */
    public function timeFrame(string $date_from, string $date_to, ?Client $client = null)
    {
        return new CurrencyTimeFrameRates($date_from, $date_to, $client, $this->config);
    }

    /**
     * @deprecated
     * @param string $date_from
     * @param string $date_to
     * @param Client|null $client
     * @return CurrencyTimeFrameRates
     */
    public function timeSeries(string $date_from, string $date_to, ?Client $client = null)
    {
        return $this->timeFrame($date_from, $date_to, $client);
    }

    /**
     * @param string $date_from
     * @param string $date_to
     * @param Client|null $client
     * @return CurrencyChange
     */
    public function change(string $date_from, string $date_to, ?Client $client = null)
    {
        return new CurrencyChange($date_from, $date_to, $client, $this->config);
    }

    /**
     * @deprecated
     * @param string $date_from
     * @param string $date_to
     * @param Client|null $client
     * @return CurrencyChange
     */
    public function fluctuations(string $date_from, string $date_to, ?Client $client = null)
    {
        return $this->change($date_from, $date_to, $client);
    }
}