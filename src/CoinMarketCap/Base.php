<?php
/*
 * (c) Thiago Régis <tregismoreira@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoinMarketCap;
use GuzzleHttp\Client;

class Base
{
    /**
     * @var string
     */
    const BASE_URL = 'https://api.coinmarketcap.com/v1/';

    /**
     * @param array $params
     * @return array
     */
    public function getTicker($params = array())
    {
        return $this->buildRequest('ticker', $params);
    }

    /**
     * @param $coinId
     * @param array $params
     * @return array
     */
    public function getTickerByCoin($coinId, $params = array())
    {
        return $this->buildRequest('ticker/' . $coin, $params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getGlobalData($params = array())
    {
        return $this->buildRequest('global', $params);
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return array
     */
    private function buildRequest($endpoint, $params = array())
    {
        $client = new Client();
        $url = $this->buildUrl(self::BASE_URL . $endpoint, $params);
        $request = $client->request('GET', $url);

        return $this->jsonDecode($request->getBody()->getContents());
    }

    /**
     * @param $url
     * @param array $params
     * @return string
     */
    private function buildUrl($url, $params = array())
    {
        $output = $url;

        if ($params) {
          $output .= '?' . http_build_query($params);
        }

        return $output;
    }

    /**
     * @param $string
     * @return mixed
     */
    private function jsonDecode($string)
    {
        return json_decode($string);
    }

}
