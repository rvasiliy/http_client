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

/**
 * Класс конфигурации
 */
final class Config {

    use Getter;

    /**
     * Базовый url.
     * Добавляется как префикс к url всех запросов
     *
     * @var string
     */
    private $baseUrl = '';

    /**
     * Сериализатор по умолчанию
     *
     * @var Serializer
     */
    private $serializer;

    public function __construct(array $config) {
        $this->baseUrl = $config['baseUrl'];

        $serializerClass    = $config['serializer']['class'];
        $serializerProperty = (isset($config['serializer']['property']) && is_array($config['serializer']['property']))
            ? $config['serializer']['property']
            : [];

        $this->serializer = ObjectFactory::create($serializerClass, $serializerProperty);
    }
}