<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyTimeFrameRates extends CurrencyRates
{
    /**
     * CurrencyHistoricalRates constructor.
     *
     * @param string      $start_date
     * @param string      $end_date
     * @param Client|null $client
     */
    public function __construct(string $start_date, string $end_date, ?Client $client = null, array $config = [])
    {
        parent::__construct($client, $config);
        $this->base_url = "https://api.exchangerate.host/timeframe";
        $this->params['start_date'] = $start_date;
        $this->params['end_date']   = $end_date;
    }

    /**
     * @param object $response
     *
     * @return mixed|null
     */
    protected function getResults(object $response)
    {
        if (!empty($time_series = (array) $response->quotes)) {
            foreach ($time_series as $date => $rates) {
                $time_series[$date] = (array) $rates;
            }
            unset($response->quotes);

            return $time_series;
        }

        return null;
    }
}