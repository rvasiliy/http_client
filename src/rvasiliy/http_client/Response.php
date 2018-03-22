<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 23:30
 */

namespace rvasiliy\http_client;


class Response {

    /**
     * Необработанный ответ сервера
     *
     * @var string
     */
    protected $rawResponse = '';

    /**
     * Сериализатор
     *
     * @var Serializer
     */
    protected $serializer;

    public function __construct() {
        $this->init();
    }

    public function init() {
        $this->serializer = HttpClient::getInstance()->getConfig()
            ->serializer;
    }

    public function getRawResponse() {
        return $this->rawResponse;
    }

    public function setRawResponse($rawResponse) {
        $this->rawResponse = $rawResponse;

        return $this;
    }

    public function getSerializer() {
        return $this->serializer;
    }

    public function setSerializer(Serializer $serializer) {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * Возвращает ответ сервера,
     * обработанный сериализатором
     *
     * @return mixed
     */
    public function getData() {
        return $this
            ->getSerializer()
            ->deserialize($this->getRawResponse());
    }
}