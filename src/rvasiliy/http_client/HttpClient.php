<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 14:33
 */

namespace rvasiliy\http_client;


/**
 * Клиент
 */
class HttpClient {
    /**
     * Объект конфигурации
     *
     * @var Config
     */
    private static $config;

    private static $instance;

    private function __construct() {
    }

    /**
     * Конфигурация клиента
     *
     * @param array $config Массив конфигурации
     */
    public static function configure(array $config = []) {
        $defaultConfig = require __DIR__ . '/config/default.php';

        self::$config = new Config(array_merge($defaultConfig, $config));
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new HttpClient();
        }

        return self::$instance;
    }

    public function getConfig() {
        if (is_null(self::$config)) {
            throw new \Exception('Объект не сконфигурирован. Запустите метод "configure" или "setConfig" с массивом конфигурации');
        }

        return self::$config;
    }

    public function setConfig(array $config) {
        self::configure($config);

        return $this;
    }

    /**
     * Отправка запроса
     *
     * @param Request $request Запрос
     * @param array $params Параметры запроса
     *
     * @return Response
     */
    public function send(Request $request, array $params = []) {
        if (!empty($params)) {
            $request->setParams($params);
        }

        return $request->execute();
    }
}