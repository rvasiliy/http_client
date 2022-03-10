<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 23:26
 */

namespace rvasiliy\http_client;


class Request {

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $method;

    /**
     * @var Response
     */
    protected $response;

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
        if ($this->method) {
            return $this->method;
        }

        return Http::METHOD_GET;
    }

    public function setMethod($method) {
        $this->method = $method;

        return $this;
    }

    public function getResponse() {
        if ($this->response) {
            return $this->response;
        }

        return new Response();
    }

    public function setResponse(Response $response) {
        $this->response = $response;

        return $this;
    }

    /**
     * Выполнение запроса
     *
     * @return Response
     * @throws HttpResponseException
     */
    public function execute() {
        $rawResponse = Http::send(
            $this->getMethod(),
            $this->prepareUrl($this->getUrl()),
            $this->getParams()
        );

        $response = $this->getResponse();
        $response->setRawResponse($rawResponse);

        return $response;
    }

    private function prepareUrl($url) {
        $baseUrl = HttpClient::getInstance()->getConfig()
            ->baseUrl;

        if ($baseUrl) {
            $separator = (strpos($url, '/') === 0) ? '' : '/';

            return $baseUrl . $separator . $url;
        }

        return $url;
    }
}
