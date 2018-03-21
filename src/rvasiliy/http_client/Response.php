<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 23:30
 */

namespace rvasiliy\http_client;


class Response {

    protected $rawResponse = '';

    protected $serializer;

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

    public function getData() {
        return $this
            ->getSerializer()
            ->deserialize($this->getRawResponse());
    }
}