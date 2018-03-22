<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 12:25
 */

namespace rvasiliy\http_client\serializer;


use rvasiliy\http_client\Serializer;
use rvasiliy\http_client\utils\Getter;
use rvasiliy\http_client\utils\Setter;

final class JsonSerializer implements Serializer {

    use Getter;
    use Setter;

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