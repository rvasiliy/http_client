<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 14:33
 */

namespace rvasiliy\http_client;


class HttpClient {
    private static $config;
    private static $instance;

    private function __construct() {}

    public static function configure(array $config = []) {
        if (!(self::$config instanceof Config)) {
            $defaultConfig = require __DIR__ . '/config/default.php';

            self::$config = new Config(array_merge($defaultConfig, $config));
        }
    }

    public static function getInstance() {
        if (!(self::$config instanceof Config)) {
            throw new \Exception('Класс не сконфигурирован. Запустите метод "configure" с массивом конфигурации');
        }

        if (!(self::$instance instanceof HttpClient)) {
            self::$instance = new HttpClient();
        }

        return self::$instance;
    }

    public function getConfig() {
        return self::$config;
    }

    public function send(Request $request, array $params = []) {
        if (!empty($params)) {
            $request->setParams($params);
        }

        return $request->execute();
    }
}