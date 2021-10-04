<?php

use yii\db\Migration;

/**
 * Class m211004_182421_dolgozo_fogyasztas
 */
class m211004_182421_dolgozo_fogyasztas extends Migration
{

    public function safeUp()
    {
        $this->createTable('dolgozo_fogyasztas', [
            'id' => $this->primaryKey(),
            'felhasznalo_id' => $this->integer()->notNull(),
            'termek_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-dolgozo_fogyasztas-felhasznalo_id',
            'dolgozo_fogyasztas',
            'felhasznalo_id',
            'felhasznalo',
            'belepesi_azonosito',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-dolgozo_fogyasztas-termek_id',
            'dolgozo_fogyasztas',
            'termek_id',
            'termek',
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {

    }
}
