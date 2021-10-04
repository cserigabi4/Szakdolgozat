<?php

use yii\db\Migration;

/**
 * Class m211004_182018_felhasznalo
 */
class m211004_182018_felhasznalo extends Migration
{

    public function safeUp()
    {
        $this->createTable('felhasznalo', [
            'belepesi_azonosito' => $this->primaryKey(),
            'nev' => $this->text()->notNull(),
            'jelszo' => $this->text()->notNull(),
            'jog' => $this->text()->notNull(),
            'szuletesi_ido' => $this->date(),
            'lakcim' => $this->text(),
            'telefon' => $this->text(),
            'ado_azonosito' => $this->text(),
        ]);
    }

    public function safeDown()
    {

    }
}
