<?php

use yii\db\Migration;

/**
 * Class m221207_043317_drop_waste_cols
 */
class m221207_043317_drop_waste_cols extends Migration
{
    public function up()
    {
        $this->dropColumn('orders', 'real_id');
        $this->dropColumn('orders', 'promocode');
        $this->dropColumn('orders', 'type');
        $this->dropColumn('orders', 'is_paid');

        $this->dropTable('goods');
        $this->dropTable('order_items');
    }

    public function down()
    {
        $this->addColumn('orders', 'real_id', $this->integer());
        $this->addColumn('orders', 'promocode', $this->string(50));
        $this->addColumn('orders', 'type', $this->integer(2));
        $this->addColumn('orders', 'is_paid', $this->boolean());

        $this->createTable('goods', [
            'id' => $this->primaryKey(),
        ]);

        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
        ]);
    }
}
