<?php

namespace app\serializers;

use app\entities\OrderEntity;
use yii\helpers\Json;

class OrderSerializer
{
    public function __construct(
        private readonly ?OrderEntity $orderEntity,
    ) {}

    public function serialize(): string
    {
        return $this->orderEntity
            ? Json::encode([
                'id' => $this->orderEntity->id,
                'real_id' => $this->orderEntity->id,
                'user_name' => $this->orderEntity->userName,
                'user_phone' => $this->orderEntity->userPhone,
                'warehouse_id' => $this->orderEntity->warehouseId,
                'created_at' => $this->orderEntity->createdAt,
                'updated_at' => $this->orderEntity->updatedAt,
                'status' => $this->orderEntity->status,
                'items_count' => $this->orderEntity->itemsCount,
            ])
            : Json::encode([]);
    }
}
