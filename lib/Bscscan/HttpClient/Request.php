<?php

namespace Bscscan\HttpClient;

use Bscscan\APIConf;
use Bscscan\Exception\ErrorException;

/**
 * Class Request
 * @package Bscscan\HttpClient
 * @author Maslakou Ihar <igormaslakoff@gmail.com>
 * @author Wespify <gh@wespify.com>
 */
class Request implements HttpClientInterface {

    /**
     * Bscscan API Key value.
     *
     * @var string
     */
    private $apiKeyToken = "";

    /**
     * Testnet name or Mainnet if null.
     *
     * @var string
     */
    private $net = null;

    /**
     * cURL handle.
     *
     * @var resource
     */
    private static $ch = null;

    public function __construct($apiKeyToken, $net = null) {
        $this->apiKeyToken = $apiKeyToken;
        $this->net = $net;
    }

    /**
     * Executes curl request to the Bscscan API.
     *
     * @param array $req Request parameters list.
     *
     * @return array JSON data.
     * @throws ErrorException If Curl error or Bscscan API error occurred.
     */
    public function exec(array $req = []) {
        usleep(250000);

        // API settings
        $req['apikey'] = $this->apiKeyToken;

        // generate the POST data string
        $postData = http_build_query($req, '', '&');

        // curl handle (initialize if required)
        if (is_null(self::$ch)) {
            self::$ch = curl_init();
            curl_setopt(self::$ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                self::$ch,
                CURLOPT_USERAGENT,
                'Mozilla/4.0 (compatible; Bscscan PHP API; ' . php_uname('a') . '; PHP/' . phpversion() . ')'
            );
        }
        curl_setopt(self::$ch, CURLOPT_URL, APIConf::getAPIUrl($this->net));
        curl_setopt(self::$ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt(self::$ch, CURLOPT_SSL_VERIFYPEER, false);

        // run the query
        $res = curl_exec(self::$ch);
        if ($res === false) {
            throw new ErrorException("Curl error: " . curl_error(self::$ch));
        }

        $json = json_decode($res, true);

        // Check for the Bscscan API error
        if (isset($json['error'])) {
            throw new ErrorException("Bscscan API error: {$json['error']}");
        }

        return $json;
    }

    /**
     * Executes simple GET request to the Bscscan public API.
     *
     * @param string $url API method URL.
     *
     * @return array JSON data.
     */
    public static function json($url) {
        $opts = [
            'http' => [
                'method' => 'GET',
                'timeout' => 10
            ]
        ];
        $context = stream_context_create($opts);
        $feed = file_get_contents($url, false, $context);
        $json = json_decode($feed, true);

        return $json;
    }

}