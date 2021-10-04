<?php

use yii\db\Migration;

/**
 * Class m211004_173009_rendeles
 */
class m211004_173009_rendeles extends Migration
{
    public function safeUp()
    {
        $this->createTable('rendeles', [
            'id' => $this->primaryKey(),
            'asztal_id' => $this->integer()->notNull(),
            'ar' => $this->integer()->notNull(),
            'allapot' => $this->boolean()->notNull(),
            'kedvezmeny' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-rendeles-asztal_id',
            'rendeles',
            'asztal_id',
            'asztal',
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('rendeles');
    }
}
