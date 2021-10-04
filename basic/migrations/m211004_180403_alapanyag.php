<?php

use yii\db\Migration;

/**
 * Class m211004_180403_alapanyag
 */
class m211004_180403_alapanyag extends Migration
{

    public function safeUp()
    {
        $this->createTable('alapanyag', [
            'id' => $this->primaryKey(),
            'nev' => $this->text()->notNull(),
            'mennyiseg' => $this->integer()->notNull(),
            'mertekegyseg' => $this->text()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('alapanyag');
    }

}
