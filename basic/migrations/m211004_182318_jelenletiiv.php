<?php

use yii\db\Migration;

/**
 * Class m211004_182318_jelenletiiv
 */
class m211004_182318_jelenletiiv extends Migration
{

    public function safeUp()
    {
        $this->createTable('jelenletiiv', [
            'id' => $this->primaryKey(),
            'felhasznalo_id' => $this->integer()->notNull(),
            'erkezet' => $this->date()->notNull(),
            'tavozott' => $this->date()->notNull(),
        ]);
    }

    public function safeDown()
    {
    }
}
