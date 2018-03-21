<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 23:19
 */

namespace rvasiliy\http_client;


class RequestTest extends \PHPUnit_Framework_TestCase {
    public function testExecute_returnResponse() {
        $request = new Request();

        $actual = $request->execute();

        $this->assertInstanceOf(Response::class, $actual, 'Запрос должен возвращать объект класса "Response"');
    }
}
