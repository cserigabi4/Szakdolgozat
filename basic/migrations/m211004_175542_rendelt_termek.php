<?php

use yii\db\Migration;

/**
 * Class m211004_175542_rendelt_termek
 */
class m211004_175542_rendelt_termek extends Migration
{
    public function safeUp()
    {
        $this->createTable('rendelt_termek', [
            'id' => $this->primaryKey(),
            'rendeles_id' => $this->integer()->notNull(),
            'termek_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-rendelt_termek-rendeles_id',
            'rendelt_termek',
            'rendeles_id',
            'rendeles',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-rendelt_termek-termek_id',
            'rendelt_termek',
            'termek_id',
            'termek',
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('rendelt_termek');
    }
}
