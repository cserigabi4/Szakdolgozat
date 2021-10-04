<?php

use yii\db\Migration;

/**
 * Class m211004_182329_napi_lista
 */
class m211004_182329_napi_lista extends Migration
{
    public function safeUp()
    {
        $this->createTable('napi_lista', [
            'id' => $this->primaryKey(),
            'felhasznalo_id' => $this->integer()->notNull(),
            'nev' => $this->text()->notNull(),
            'leiras' => $this->text()->notNull(),
            'felvette' =>  $this->integer()->notNull(),
            'fontossag' => $this->text()->notNull(),
            'allapot' => $this->text()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-napi_lista-felhasznalo_id',
            'napi_lista',
            'felhasznalo_id',
            'felhasznalo',
            'belepesi_azonosito',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-napi_lista-felvette',
            'napi_lista',
            'felvette',
            'felhasznalo',
            'belepesi_azonosito',
            'CASCADE'
        );

    }

    public function safeDown()
    {

    }
}
