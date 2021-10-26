<?php

namespace Mutahir\Carsdbapi\connectors;


use \Mutahir\Carsdbapi\IConnector;
use \Mutahir\Carsdbapi\exceptions\EmptyResponseException;
use \Mutahir\Carsdbapi\connectors\Curl;


class CurlGetConnector implements IConnector
{
    /** @var string */
    private $_url;

    /** @var string */
    private $_api_kei;

    public $_tmp_dir;

    public $timeout = 0; // 0 - without limit

    /**
     * SimpleConnector constructor.
     *
     * @param string $api_kei
     * @param string $url
     * @param string $tmp_dir
     */
    public function __construct($api_kei, $url = 'https://api.basebuy.ru/api/auto/v1/', $tmp_dir = null)
    {
        $this->_api_kei = $api_kei;
        $this->_url     = $url;
        $this->_tmp_dir = $tmp_dir ? $tmp_dir : sys_get_temp_dir();
    }


    public function get($method, $format, $params = [])
    {

        $result = null;
        $curl   = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $this->timeout);
        $curl->get($this->_url . $method . '.' . $format, $this->addApiKey($params));
        if ($curl->error) {
            throw new EmptyResponseException($curl->errorMessage,  $curl->errorCode);
        } else {
            $result = $curl->response;
        }
        $curl->close();
        return $result;
    }

    public function download($method, $format, $params = [])
    {
        $requestUrl = implode('?', [
            $this->_url . $method . '.' . $format,
            http_build_query($this->addApiKey($params)),
        ]);

        $resultFileName = $this->_tmp_dir . $method . '.' . $format;
        $curl = new Curl();
        $curl->setOpt(CURLOPT_TIMEOUT, $this->timeout);
        if ($curl->download($requestUrl, $resultFileName)) {
            $result = $resultFileName;
        } else {
            throw new EmptyResponseException($curl->errorMessage,  $curl->errorCode);
        }
        $curl->close();

        return $result;
    }

    protected function addApiKey($params)
    {
        $params['api_key'] = $this->_api_kei;

        return $params;
    }
}
