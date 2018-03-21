<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 11:49
 */

namespace rvasiliy\http_client;


use rvasiliy\http_client\serializer\StringSerializer;

class StringSerializerTest extends \PHPUnit_Framework_TestCase {
    public function test_isSerializerType() {
        $expected = 'rvasiliy\\http_client\\Serializer';
        $actual = new StringSerializer();

        $this->assertInstanceOf($expected, $actual, 'Класс не реализует интерфейс Serializer');
    }

    public function testDeserialize_returnSame() {
        $stringSerializer = new StringSerializer();
        $rawResponse = '{"field":"value"}';

        $expected = $rawResponse;
        $actual = $stringSerializer->deserialize($rawResponse);

        $this->assertEquals($expected, $actual, 'Десериализация должна вернуть тот же самый объект');
    }
}
