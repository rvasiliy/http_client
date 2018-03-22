<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 19:30
 */

namespace rvasiliy\http_client;


class HttpClientTest extends \PHPUnit_Framework_TestCase {
    public function testSend_withoutConfig_throwException() {
        $this->expectException('\\Exception');

        HttpClient::getInstance()->send(new Request());
    }

    public function testGetInstance_returnInstance() {
        HttpClient::configure();

        $instance = HttpClient::getInstance();

        $this->assertInstanceOf(HttpClient::class, $instance);
    }

    public function testConfigure_instanceConfig() {
        HttpClient::configure();

        $this->assertAttributeInstanceOf(Config::class, 'config', HttpClient::class);
    }

    public function testSend_returnResponse() {
        HttpClient::configure();

        $httpClient = HttpClient::getInstance();

        $actual = $httpClient->send(new Request());

        $this->assertInstanceOf(Response::class, $actual);
    }
}
