<?php

use yii\db\Migration;

/**
 * Class m221207_114101_add_default_to_created_at
 */
class m221207_114101_add_default_to_created_at extends Migration
{
    public function up()
    {
        $this->dropColumn('orders', 'created_at');
        $this->addColumn(
            'orders',
            'created_at',
            $this->dateTime()->notNull()->defaultExpression('NOW()')
        );
    }

    public function down()
    {
    }
}
