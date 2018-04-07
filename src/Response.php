<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 23:30
 */

namespace rvasiliy\http_client;


use rvasiliy\http_client\serializer\StringSerializer;

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

    public function getRawResponse() {
        return $this->rawResponse;
    }

    public function setRawResponse($rawResponse) {
        $this->rawResponse = $rawResponse;

        return $this;
    }

    public function getSerializer() {
        if ($this->serializer) {
            return $this->serializer;
        }

        return new StringSerializer();
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