<?php

namespace app\repositories;

use app\entities\OrderEntity;
use app\helpers\DateFormatter;
use DateTime;
use yii\db\Exception;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class OrdersRepository
{
    /**
     * Получение id существующих заказов
     * @return int[]
     */
    public function getExistingOrderIds(): array
    {
        $ids = (new Query())
            ->select('id')
            ->from('orders')
            ->all();

        return ArrayHelper::getColumn($ids, 'id');
    }

    /**
     * Создание записей заказа
     * @param array $orders
     * @throws Exception
     */
    public function create(array $orders): void
    {
        (new Query())->createCommand()->batchInsert(
            'orders',
            [
                'id',
                'user_name',
                'user_phone',
                'warehouse_id',
                'status',
                'items_count',
            ],
            $orders
        )->execute();
    }

    /**
     * Обновление записи заказа
     * @param OrderEntity $orderEntity
     * @throws Exception
     */
    public function update(OrderEntity $orderEntity): void
    {
        (new Query())->createCommand()->update(
            'orders',
            [
                'user_name' => $orderEntity->userName,
                'user_phone' => $orderEntity->userPhone,
                'warehouse_id' => $orderEntity->warehouseId,
                'status' => $orderEntity->status,
                'items_count' => $orderEntity->itemsCount,
                'updated_at' => (new DateTime())->format(DateFormatter::DATETIME_FORMAT)
            ],
            ['id' => $orderEntity->id]
        )->execute();
    }

    public function findById(int $id): ?OrderEntity
    {
        $order = (new Query())->select('*')
            ->from('orders')
            ->where(['id' => $id])
            ->one();

        return $order
            ? (new OrderEntity(
                id: $order['id'],
                userName: $order['user_name'],
                userPhone: $order['user_phone'],
                warehouseId: $order['id'],
                status: $order['status'],
                itemsCount: $order['items_count'],
                createdAt: $order['created_at'],
                updatedAt: $order['updated_at'],
            ))
            : null;
    }
}