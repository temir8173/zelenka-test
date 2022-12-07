<?php

namespace app\services;

use app\repositories\OrdersRepository;
use app\entities\OrderEntity;
use yii\db\Exception;

class SaveOrdersFromFileService
{
    public array $orders;
    public array $newOrders= [];
    public int $updatedOrdersCount = 0;

    public function __construct(
        private readonly OrdersRepository $ordersRepository,
    ) {
    }

    /**
     * @throws Exception
     */
    public function process(array $orders): void
    {
        $this->orders = $orders;
        $existingOrderIds = $this->ordersRepository->getExistingOrderIds();

        foreach ($this->orders as $order) {
            if (!isset($order['id']) || !isset($order['user_name'])) {
                continue;
            }

            $orderEntity = new OrderEntity(
                id: (int)$order['id'],
                userName: $order['user_name'],
                userPhone: $order['user_phone'],
                warehouseId: (int)$order['warehouse_id'],
                status: (int)$order['status'],
                itemsCount: count($order['items']) ?? 0,
            );

            if (!in_array($order['id'], $existingOrderIds)) {
                $this->newOrders[] = $orderEntity->asArray();
            } else {
                $this->ordersRepository->update($orderEntity);
                $this->updatedOrdersCount++;
            }
        }

        if ($this->newOrders) {
            $this->ordersRepository->create($this->newOrders);
        }
    }
}
