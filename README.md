# HttpClient

[![Build Status](https://travis-ci.org/RVasiliy/http_client.svg)](https://travis-ci.org/RVasiliy/http_client)

## Описание

__HttpClient__ - библиотека для создания систем для отправки и получения запросов посредством _http_ протокола. Например _REST_ сервисов.

## Зависимости

* __PHP:__ версия 5.6 и выше

## Конфигурация

Для работы клиент может быть сконфигурирован посредством массива конфигурации. Конфигурация по умолчанию выглядит следующим образом:

```php
    $config = [
        // базовый url, который будет добавлен как префикс к другим
        'baseUrl' => '',

        'serializer' => [
            'class' => 'rvasiliy\\http_client\\serializer\\StringSerializer',
        ],
    ];
```

Если требуется обрабатывать ответы в формате _json_, то конфигурация должна быть такой:

```php
    $config = [
        // базовый url, который будет добавлен как префикс к другим
        'baseUrl' => '',

        'serializer' => [
            'class' => 'rvasiliy\\http_client\\serializer\\JsonSerializer',
            'property' => [
                // true - данные в виде массива
                // false - данные в виде объекта
                'asArray' => true,
            ],
        ],
    ];
```

## Создание и конфигурация клиента

```php
    require __DIR__ . '/vendor/autoload.php';

    \rvasiliy\http_client\HttpClient::configure($config);
    $client = \rvasiliy\http_client\HttpClient::getInstance();
```

или

```php
    require __DIR__ . '/vendor/autoload.php';

    $client = \rvasiliy\http_client\HttpClient::getInstance();
    $client->setConfig($config);
```

Получить доступ к объекту конфигурации можно так:

```php
    $config = \rvasiliy\http_client\HttpClient::getInstance()->getConfig();
```

Это можно использовать для получения доступа к переменным конфигурации по всему приложению.

## Отправка запросов

```php
    // создаем объект запроса
    $request = new \rvasiliy\http_client\Request();
    $request->setUrl('http://example.com/status');
    $request->setParams(['name' => 'Jon']);

    // отправляем запрос и получаем ответ
    $response = $client->send($request);
```

## Получение данных

Когда объект ответа получен, из него можно получить данные.

```php
    $data = $response->getData();
```

Формат получаемых данных зависит от используемого сериализатора в объекте ответа.

* __StringSerializer__ - данные не изменяются и возвращаются в таком же виде, в котором они були получены с сервера;

* __JsonSerializer__ - преобразует данные в массив или объект в зависимости от настроек;

* Вы также можете создавать свои сериализаторы, реализуя интерфейс _rvasiliy\http_client\Serializer_.

Доступ к объекту сериализатора возможен через объект ответа:

```php
    $serializer = $response->getSerializer();
```

## Пример кода. Все вместе

```php
    // подключаем автозагрузчик классов
    require __DIR__ . '/vendor/autoload.php';

    // массив конфигурации
    $config = [
        'baseUrl' => 'http://example.com',
        'serializer' => [
            'class' => 'rvasiliy\\http_client\\serializer\\JsonSerializer',
            'property' => [
                'asArray' => false,
            ],
        ],
    ];

    // создаем и конфигурируем клиент
    $client = \rvasiliy\http_client\HttpClient::getInstance();
    $client->setConfig($config);

    // создаем объект запроса
    $request = new \rvasiliy\http_client\Request();
    $request->setUrl('/status');
    $request->setParams(['name' => 'Jon']);

    // отправляем запрос
    $response = $client->send($request);

    // получаем данные
    $data = $response->getData();
```
