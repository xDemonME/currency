<?php

namespace AmrShawky;

use AmrShawky\Traits\HttpRequest;
use Closure;
use GuzzleHttp\Client;

abstract class API
{
    use HttpRequest;

    /**
     * @var null
     */
    protected $base_url  = null;

    /**
     * @var bool
     */
    protected $use_https = false;

    /**
     * @var array
     */
    protected $query_params = [];

    /**
     * @var array
     */
    protected $query_params_callback = null;

    /**
     * @var string|null
     */
    protected $access_key = null;

    /**
     * CurrencyConversion constructor.
     *
     * @param Client|null $client
     * @param array $config
     */
    public function __construct(?Client $client = null, array $config = [])
    {
        $this->base_url = $config['base_url'] ?? $this->base_url;
        $this->access_key = $config['access_key'] ?? $this->access_key;
        $this->client = $client;
    }

    /**
     * @param Object $response
     *
     * @return mixed
     */
    protected abstract function getResults(Object $response);

    protected function buildQueryParams()
    {
        if ($this->query_params_callback !== null) {
            $this->query_params = call_user_func($this->query_params_callback);
        }

        if (!is_array($this->query_params)) {
            throw new \Exception('Query params should be an array!');
        }

        if (property_exists(get_called_class(), 'params') && !empty($this->params)) {
            foreach ($this->params as $key => $param) {
                $this->query_params[$key] = $param;
            }
        }

        if (!is_null($this->access_key)) {
            $this->query_params['access_key'] = $this->access_key;
        }
    }

    /**
     * @return mixed|null
     * @throws \Exception
     */
    public function get()
    {
        $this->buildQueryParams();

        $url = $this->base_url;

        if (!$this->use_https) {
            $url = str_replace('https', 'http', $url);
        }

        $response = $this->request(
            $url,
            $this->query_params
        );

        return $response ? $this->getResults($response) : null;
    }

    /**
     * @param Closure $callback
     */
    protected function setQueryParams(Closure $callback)
    {
        $this->query_params_callback = $callback;
    }


    /**
     * @param string $access_key
     * @return API
     */
    public function setAccessKey(string $access_key): API
    {
        $this->access_key = $access_key;

        return $this;
    }

    /**
     * @param bool $use_https
     * @return $this
     */
    public function useHTTPS(bool $use_https = false): API
    {
        $this->use_https = $use_https;

        return $this;
    }

    /**
     * @param          $condition
     * @param callable $callback
     *
     * @return $this
     */
    public function when($condition, callable $callback)
    {
        if ($condition) {
            $callback($this, $condition);
        }

        return $this;
    }
}