<?php

use yii\db\Migration;

/**
 * Class m211004_181434_termek_osszetevoi
 */
class m211004_181434_termek_osszetevoi extends Migration
{
    public function safeUp()
    {
        $this->createTable('termek_osszetevoi', [
            'termek_id' => $this->integer()->notNull(),
            'alapanyag_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-termek_osszetevoi-termek_id',
            'termek_osszetevoi',
            'termek_id',
            'termek',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-termek_osszetevoi-alapanyag_id',
            'termek_osszetevoi',
            'alapanyag_id',
            'alapanyag',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
    }
}
