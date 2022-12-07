<?php

namespace app\entities;

class OrderEntity
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $userName,
        public readonly ?string $userPhone,
        public readonly ?int $warehouseId,
        public readonly ?int $status,
        public readonly int $itemsCount = 0,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null
    ) {
    }

    public function asArray(): array
    {
        return [
            $this->id,
            $this->userName,
            $this->userPhone,
            $this->warehouseId,
            $this->status,
            $this->itemsCount,
        ];
    }
}
