<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 23:26
 */

namespace rvasiliy\http_client;


class Request {

    protected $url = '';

    protected $params = [];

    protected $method = Http::METHOD_GET;

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    public function getParams() {
        return $this->params;
    }

    public function setParams(array $params) {
        $this->params = $params;

        return $this;
    }

    public function getMethod() {
        return $this->method;
    }

    public function setMethod($method) {
        $this->method = $method;

        return $this;
    }

    public function execute() {
        $rawResponse = Http::send($this->getMethod(), $this->getUrl(), $this->getParams());
        $serializer = HttpClient::getInstance()
            ->getConfig()
            ->serializer;

        $response = new Response();
        $response->setRawResponse($rawResponse)
            ->setSerializer($serializer);

        return $response;
    }
}