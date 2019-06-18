<?php
namespace Puzzle9\Kuaidi100;

use Puzzle9\Kuaidi100\Exceptions\HttpException;
use Puzzle9\Kuaidi100\Exceptions\InvalidArgumentException;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
* 2019年6月18日
*/
class Express
{
    protected $key;
    protected $customer;
    protected $callbackurl;

    protected $guzzleOptions = [
        'verify' => false,
        'http_errors' => false,
        'timeout' => 5,
    ];

    public function __construct($key, $customer, $callbackurl=null)
    {
        if (empty($key)) {
            throw new InvalidArgumentException('没有 key');
        }

        if (empty($customer)) {
            throw new InvalidArgumentException('没有 customer');
        }

        $this->key = $key;
        $this->customer = $customer;
        $this->callbackurl = $callbackurl;
    }

    /*
    实时查询
    https://poll.kuaidi100.com/manager/page/document/synquery
     */
    public function synquery($com, $num, $phone=null)
    {
        if ($com == 'shunfeng' && empty($phone)) {
            throw new InvalidArgumentException('顺丰 必须填写手机号');
        }

        $data = [
            'com' => $com,
            'num' => $num,
            'phone' => $phone,
        ];

        $param = json_encode($data);

        $customer = $this->customer;

        try {
            $res = $this->getHttpClient()->request('POST', 'https://poll.kuaidi100.com/poll/query.do', [
                'form_params' => [
                    'customer' => $customer,
                    'param' => $param,
                    'sign' => strtoupper(md5($param.$this->key.$customer)),
                ],
            ])->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

        return $res;
    }

    /*
    智能判断公司编码
    https://poll.kuaidi100.com/manager/page/document/autonumber
     */
    public function autonumber($num)
    {
        try {
            $res = $this->getHttpClient()->request('GET', 'http://www.kuaidi100.com/autonumber/auto', [
                'query' => [
                    'key' => $this->key,
                    'num' => $num,
                ],
            ])->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

        return $res;
    }

    /*
    订阅推送
    https://poll.kuaidi100.com/manager/page/document/subscribe
     */
    public function subscribe($company, $number)
    {
        $param = json_encode([
            'company' => $company,
            'number' => $number,
            'key' => $this->key,
            'parameters' => [
                'callbackurl' => $this->callbackurl,
                'resultv2' => 2,
                'autoCom' => 1,
            ],
        ]);
        
        try {
            $res = $this->getHttpClient()->request('POST', 'https://poll.kuaidi100.com/poll', [
                'form_params' => [
                    'schema' => 'json',
                    'param' => $param,
                ],
            ])->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

        return $res;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }
}