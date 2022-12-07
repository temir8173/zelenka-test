<?php

use yii\db\Migration;

/**
 * Class m221207_103117_rm_unique_index
 */
class m221207_103117_rm_unique_index extends Migration
{
    public function up()
    {
        $this->dropIndex('user_name', 'orders');
    }

    public function down()
    {
    }
}
