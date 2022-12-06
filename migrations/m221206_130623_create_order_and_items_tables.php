<?php

use yii\db\Migration;

/**
 * Class m221206_130623_create_order_and_items_tables
 */
class m221206_130623_create_order_and_items_tables extends Migration
{
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'real_id' => $this->integer(),
            'user_name' => $this->string()->notNull()->unique(),
            'user_phone' => $this->string(20),
            'warehouse_id' => $this->string(),
            'status' => $this->integer(4),
            'is_paid' => $this->boolean(),
            'promocode' => $this->string(50),
            'type' => $this->integer(2),
            'items_count' => $this->integer(2),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'manufacturer' => $this->string(),
            'barcodes' => $this->string(),
            'price' => $this->float()->notNull(),
        ]);

        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'good_id' => $this->integer(8),
            'quantity' => $this->string()->notNull(),
            'amount' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('orders');
        $this->dropTable('goods');
        $this->dropTable('order_items');
    }
}
