<?php

namespace app\forms;

use yii\base\Model;

class ReceiveOrderForm extends Model
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
        ];
    }

    public function getId(): int
    {
        return (int)$this->id;
    }
}