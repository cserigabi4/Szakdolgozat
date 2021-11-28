<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategoria".
 *
 * @property int $id
 * @property string $nev
 * @property int $afa_kulcs
 * @property boolean $allergen
 *
 * @property Termek[] $termeks
 */
class Kategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nev', 'afa_kulcs', 'allergen'], 'required'],
            [['nev'], 'string'],
            [['afa_kulcs'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nev' => 'Nev',
            'afa_kulcs' => 'Afa Kulcs',
            'allergen' => 'Allergen',
        ];
    }

    /**
     * Gets query for [[Termeks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTermeks()
    {
        return $this->hasMany(Termek::className(), ['kategoria_id' => 'id']);
    }
    public function getTermekek()
    {
        return Termek::findAll(['kategoria_id' => $this->id]);
    }
}
