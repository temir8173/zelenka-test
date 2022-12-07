<?php

use app\repositories\OrdersRepository;
use app\services\SaveOrdersFromFileService;

return [
    'definitions' => [
        SaveOrdersFromFileService::class => SaveOrdersFromFileService::class,
        OrdersRepository::class => OrdersRepository::class,
    ],
];
