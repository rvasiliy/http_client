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

    /**
     * Объект запроса
     *
     * @var Request
     */
    private $request;

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
            self::configure();
        }

        return self::$config;
    }

    public function setConfig(array $config) {
        self::configure($config);

        return $this;
    }

    public function getRequest() {
        return $this->request;
    }

    public function setRequest(Request $request) {
        $this->request = $request;

        return $this;
    }

    /**
     * Отправка запроса
     *
     * @param Request $request Запрос
     * @param array $params Параметры запроса
     *
     * @return Response
     * @throws \Exception
     */
    public function send(Request $request = null, array $params = []) {
        if ($request) {
            $this->setRequestParams($request, $params);

            return $request->execute();
        }

        if (is_null($this->getRequest())) {
            throw new \Exception('Не установлен объект запроса');
        }

        $this->setRequestParams($this->getRequest(), $params);

        return $this->getRequest()->execute();
    }

    private function setRequestParams(Request $request, array $params) {
        if (is_null($request)) {
            return;
        }

        $request->setParams($params);
    }
}