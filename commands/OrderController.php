<?php

namespace app\commands;

use app\forms\ReceiveOrderForm;
use app\repositories\OrdersRepository;
use app\serializers\OrderSerializer;
use Exception;
use app\services\SaveOrdersFromFileService;
use yii\console\Controller;
use yii\helpers\Json;

/**
 * Утилита получает данные о заказах из файла или из сети интернет, разбирает и сохраняет в БД. Также утилита
 * позволяет просмотреть информацию о заказе.
 */
class OrderController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly SaveOrdersFromFileService $saveOrdersFromFileService,
        private readonly OrdersRepository $ordersRepository,

        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * Получить файл из файловой системы
     * @param string $url
     * @throws \yii\db\Exception
     */
    public function actionUpdateNet($url = 'https://zelenka.ru/sample/orders.json') {
        try {
            $data = file_get_contents($url);
        } catch (Exception $e) {
            echo 'Ошибка: ' . $e->getMessage();
            exit(1);
        }

        $dataDecoded = Json::decode($data);
        $this->saveOrdersFromFileService->process($dataDecoded['orders']);

        echo "Всего заказов в файле: " . count($this->saveOrdersFromFileService->orders) . PHP_EOL
            . "Создано новых записей: " . count($this->saveOrdersFromFileService->newOrders) . PHP_EOL
            . "Обновлено записей: " . $this->saveOrdersFromFileService->updatedOrdersCount;
        exit(0);
    }

    /**
     * Получить файл из файловой системы
     * @param string $path
     * @throws \yii\db\Exception
     */
    public function actionUpdateLocal($path = 'C:\Users\Workstation\Downloads\orders.json') {
        try {
            $data = file_get_contents($path);
        } catch (Exception $e) {
            echo 'Ошибка: ' . $e->getMessage();
            exit(1);
        }

        $dataDecoded = Json::decode($data);
        $this->saveOrdersFromFileService->process($dataDecoded['orders']);

        echo "Всего заказов в файле: " . count($this->saveOrdersFromFileService->orders) . PHP_EOL
            . "Создано новых записей: " . count($this->saveOrdersFromFileService->newOrders) . PHP_EOL
            . "Обновлено записей: " . $this->saveOrdersFromFileService->updatedOrdersCount;
        exit(0);
    }

    /**
     * Выдать информацию о заказе
     * @param int $orderId
     */
    public function actionInfo($orderId)
    {
        $form = new ReceiveOrderForm();
        $form->setAttributes(['id' => $orderId]);

        if ($form->validate()) {
            $order = $this->ordersRepository->findById($form->getId());

            echo (new OrderSerializer($order))->serialize();
        } else {
            echo Json::encode($form->getErrorSummary(true));
        }
    }
}
