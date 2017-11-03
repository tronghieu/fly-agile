<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 10/30/17
 * Time: 23:06
 */

namespace App\Library;

class ApiResponseData
{
    protected $httpCode = 200;
    protected $data;

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @param int $httpCode
     */
    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }
}