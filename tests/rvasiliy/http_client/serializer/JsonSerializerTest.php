<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 12:23
 */

namespace rvasiliy\http_client\serializer;


class JsonSerialiserTest extends \PHPUnit_Framework_TestCase {
    public function test_isSerializerType() {
        $expected = 'rvasiliy\\http_client\\Serializer';
        $actual   = new JsonSerializer();

        $this->assertInstanceOf($expected, $actual, 'Класс не реализует интерфейс Serializer');
    }

    public function testAsObject_setReturnAsObject() {
        $jsonSerializer = new JsonSerializer();

        $expected = false;
        $jsonSerializer->asObject();

        $this->assertAttributeEquals($expected, 'asArray', $jsonSerializer);
    }

    public function testAsArray_setReturnAsArray() {
        $jsonSerializer = new JsonSerializer();

        $expected = true;
        $jsonSerializer->asArray();

        $this->assertAttributeEquals($expected, 'asArray', $jsonSerializer);
    }

    public function testDeserialize_returnArrayDefault() {
        $jsonSerializer = new JsonSerializer();
        $rawResponse = '{"field":"value"}';

        $expected = ['field' => 'value'];
        $actual = $jsonSerializer->deserialize($rawResponse);

        $this->assertEquals($expected, $actual, 'Десериализация отработала неверно. Должен вернуться массив');
    }

    public function testDeserialize_returnArray() {
        $jsonSerializer = new JsonSerializer();
        $rawResponse = '{"field":"value"}';

        $expected = ['field' => 'value'];
        $actual = $jsonSerializer
            ->asArray()
            ->deserialize($rawResponse);

        $this->assertEquals($expected, $actual, 'Десериализация отработала неверно. Должен вернуться массив');
    }

    public function testDeserialize_returnObject() {
        $jsonSerializer = new JsonSerializer();
        $rawResponse = '{"field":"value"}';

        $expected = new \stdClass();
        $expected->field = 'value';

        $actual = $jsonSerializer
            ->asObject()
            ->deserialize($rawResponse);

        $this->assertEquals($expected, $actual, 'Десериализация отработала неверно. Должен вернуться объект');
    }
}
