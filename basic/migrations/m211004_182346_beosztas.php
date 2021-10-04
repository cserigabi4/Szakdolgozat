<?php

use yii\db\Migration;

/**
 * Class m211004_182346_beosztas
 */
class m211004_182346_beosztas extends Migration
{
    public function safeUp()
    {
        $this->createTable('beosztas', [
            'id' => $this->primaryKey(),
            'felhasznalo_id' => $this->integer()->notNull(),
            'datum' => $this->date()->notNull(),
            'kezdes' => $this->date()->notNull(),
            'tavozas' =>  $this->date()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-beosztas-felhasznalo_id',
            'beosztas',
            'felhasznalo_id',
            'felhasznalo',
            'belepesi_azonosito',
            'CASCADE'
        );

    }

    public function safeDown()
    {
    }
}
