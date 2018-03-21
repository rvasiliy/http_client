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

    private function __construct(array $config) {
        $defaultConfig = require __DIR__ . '/config/default.php';

        self::$config = new Config(array_merge($defaultConfig, $config));
    }

    public static function configure(array $config = []) {
        if (!(self::$instance instanceof HttpClient)) {
            self::$instance = new HttpClient($config);
        }
    }

    public static function getInstance() {
        if (self::$instance instanceof HttpClient) {
            return self::$instance;
        }

        throw new \Exception('Объект не сконфигурирован. Запустите метод "configure" с массивом конфигурации');
    }

    public function getConfig() {
        return self::$config;
    }
}