<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 11:56
 */

namespace rvasiliy\http_client;


interface Serializer {
    public function deserialize($rawResponse);
}