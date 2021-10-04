<?php

use yii\db\Migration;

/**
 * Class m211004_181840_napibevetel
 */
class m211004_181840_napibevetel extends Migration
{

    public function safeUp()
    {
        $this->createTable('napibevetel', [
            'id' => $this->primaryKey(),
            'datum' => $this->date()->notNull(),
            'ar' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
    }
}
