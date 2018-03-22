<?php
/**
 * Created by PhpStorm.
 * User: RVasiliy
 * Date: 21.03.2018
 * Time: 15:19
 */

namespace rvasiliy\http_client\utils;


/**
 * Конструктор объектов
 */
class ObjectFactory {

    /**
     * Создание объекта
     *
     * @param string $className Имя класса
     * @param array $params Значения полей
     *
     * @return Object
     */
    public static function create($className, array $params = []) {
        $obj = new $className;

        foreach ($params as $field => $value) {
            $obj->$field = $value;
        }

        return $obj;
    }
}