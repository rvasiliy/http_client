<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 18:48
 */

namespace rvasiliy\http_client\utils;


trait Setter {
    public function __set($field, $value) {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        } else {
            throw new \Exception('Поля "' . $field . '" в классе "' . get_class($this) . '" не существует');
        }
    }
}