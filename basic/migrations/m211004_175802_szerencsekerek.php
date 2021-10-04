<?php

use yii\db\Migration;

/**
 * Class m211004_175802_szerencsekerek
 */
class m211004_175802_szerencsekerek extends Migration
{

    public function safeUp()
    {
        $this->createTable('szerencsekerek', [
            'id' => $this->primaryKey(),
            'nev' => $this->text()->notNull(),
            'ertek' => $this->text()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('szerencsekerek');
    }
}
