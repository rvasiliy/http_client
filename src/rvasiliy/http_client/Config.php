<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 15:04
 */

namespace rvasiliy\http_client;


use rvasiliy\http_client\utils\Getter;
use rvasiliy\http_client\utils\ObjectFactory;

final class Config {

    use Getter;

    private $baseUrl = '';

    private $requestNamespace = '';

    private $responseNamespace = '';

    private $serializer = null;

    public function __construct(array $config) {
        $this->baseUrl           = $config['baseUrl'];
        $this->requestNamespace  = $config['requestNamespace'];
        $this->responseNamespace = $config['responseNamespace'];

        $serializerClass    = $config['serializer']['class'];
        $serializerProperty = (isset($config['serializer']['property']) && is_array($config['serializer']['property']))
            ? $config['serializer']['property']
            : [];

        $this->serializer = ObjectFactory::create($serializerClass, $serializerProperty);
    }
}