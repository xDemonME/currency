<?php

namespace AmrShawky;

use GuzzleHttp\Client;

class CurrencyChange extends CurrencyRates
{
    /**
     * CurrencyFluctuations constructor.
     *
     * @param string $start_date
     * @param string $end_date
     * @param Client|null $client
     * @param array $config
     */
    public function __construct(string $start_date, string $end_date, ?Client $client = null, array $config = [])
    {
        parent::__construct($client, $config);
        $this->base_url = "https://api.exchangerate.host/change";
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
        if (!empty($fluctuations = (array) $response->quotes)) {
            foreach ($fluctuations as $currency => $results) {
                $fluctuations[$currency] = (array) $results;
            }
            unset($response->quotes);

            return $fluctuations;
        }

        return null;
    }
}