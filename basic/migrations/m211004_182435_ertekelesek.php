<?php

use yii\db\Migration;

/**
 * Class m211004_182435_ertekelesek
 */
class m211004_182435_ertekelesek extends Migration
{
    public function safeUp()
    {
        $this->createTable('ertekelesek', [
            'id' => $this->primaryKey(),
            'nev' => $this->text(),
            'leiras' => $this->text()->notNull(),
            'pont' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {

    }
}
