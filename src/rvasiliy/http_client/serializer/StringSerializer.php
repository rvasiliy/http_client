<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 11:55
 */

namespace rvasiliy\http_client\serializer;


use rvasiliy\http_client\Serializer;

final class StringSerializer implements Serializer {

    public function serialize($model) {
        // TODO: Implement serialize() method.
    }

    public function deserialize($rawResponse) {
        return $rawResponse;
    }
}