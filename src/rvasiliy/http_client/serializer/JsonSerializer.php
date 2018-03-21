<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 12:25
 */

namespace rvasiliy\http_client\serializer;


use rvasiliy\http_client\Serializer;

class JsonSerializer implements Serializer {
    private $asArray = true;

    public function serialize($model) {
        // TODO: Implement serialize() method.
    }

    public function deserialize($rawResponse) {
        return json_decode($rawResponse, $this->asArray);
    }

    public function asObject() {
        $this->asArray = false;

        return $this;
    }

    public function asArray() {
        $this->asArray = true;

        return $this;
    }
}