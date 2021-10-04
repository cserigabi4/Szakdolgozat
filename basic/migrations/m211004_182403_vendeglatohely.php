<?php

use yii\db\Migration;

/**
 * Class m211004_182403_vendeglatohely
 */
class m211004_182403_vendeglatohely extends Migration
{
    public function safeUp()
    {
        $this->createTable('vendeglatohely', [
            'id' => $this->primaryKey(),
            'nev' => $this->text()->notNull(),
            'adoszam' => $this->text()->notNull(),
            'cim' => $this->text()->notNull(),
            'telefon' => $this->text(),
        ]);
    }

    public function safeDown()
    {
    }
}
