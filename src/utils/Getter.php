<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 15:33
 */

namespace rvasiliy\http_client\utils;


trait Getter {
    public function __get($field) {
        if (property_exists($this, $field)) {
            return $this->$field;
        } else {
            throw new \Exception('Поля "' . $field . '" в классе "' . get_class($this) . '" не существует');
        }
    }
}