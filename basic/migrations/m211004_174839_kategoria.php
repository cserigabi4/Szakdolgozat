<?php

use yii\db\Migration;

/**
 * Class m211004_174839_kategoria
 */
class m211004_174839_kategoria extends Migration
{
    public function safeUp()
    {
        $this->createTable('kategoria', [
            'id' => $this->primaryKey(),
            'nev' => $this->text()->notNull(),
            'afa_kulcs' => $this->integer()->notNull(),
            'allergen' => $this->boolean()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('kategoria');
    }
}
