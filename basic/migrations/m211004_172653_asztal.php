<?php

use yii\db\Migration;
/**
 * Class m211004_172653_asztal
 */
class m211004_172653_asztal extends Migration
{

    public function safeUp()
    {
        $this->createTable('asztal', [
            'id' => $this->primaryKey(),
            'qr' => $this->text(),
            'x' => $this->integer(),
            'y' => $this->integer(),
        ]);
    }


    public function safeDown()
    {
        $this->dropTable('asztal');
    }
}
