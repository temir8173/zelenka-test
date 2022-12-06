<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Утилита получает данные о заказах из файла или из сети интернет, разбирает и сохраняет в БД. Также утилита
 * позволяет просмотреть информацию о заказе.
 */
class OrderController extends Controller
{
    /**
     * Получить файл из сети
    */
    public function actionUpdateNet()
    {
        echo '$message' . "\n";
    }

    /**
     * Получить файл из файловой системы
     */
    public function actionUpdateLocal()
    {
        echo '$message' . "\n";
    }

    /**
     * Выдать информацию о заказе
     * @param int $orderId
     */
    public function actionInfo($orderId)
    {
        echo $orderId . "\n";
    }
}