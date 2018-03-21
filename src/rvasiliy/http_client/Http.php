<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 13:53
 */

namespace rvasiliy\http_client;


final class Http {
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    public static function get($url, array $params = []) {
        return self::send(self::METHOD_GET, $url, $params);
    }

    public static function post($url, array $params = []) {
        return self::send(self::METHOD_POST, $url, $params);
    }

    private static function send($method, $url, array $params = []) {
        $ch = curl_init();

        if (self::METHOD_GET === $method) {
            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
            }
        } else if (self::METHOD_POST === $method) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $rawResponse = curl_exec($ch);

        curl_close($ch);

        return $rawResponse;
    }
}