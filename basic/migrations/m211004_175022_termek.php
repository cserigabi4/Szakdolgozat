<?php

use yii\db\Migration;

/**
 * Class m211004_175022_termek
 */
class m211004_175022_termek extends Migration
{
    public function safeUp()
    {
        $this->createTable('termek', [
            'id' => $this->primaryKey(),
            'kategoria_id' => $this->integer()->notNull(),
            'ar' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-termek-kategoria_id',
            'termek',
            'kategoria_id',
            'kategoria',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('termek');
    }
}
