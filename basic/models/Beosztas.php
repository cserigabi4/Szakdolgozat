<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "beosztas".
 *
 * @property int $id
 * @property int $felhasznalo_id
 * @property string $datum
 * @property string $kezdes
 * @property string $tavozas
 *
 * @property Felhasznalo $felhasznalo
 */
class Beosztas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'beosztas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['felhasznalo_id', 'datum', 'kezdes', 'tavozas'], 'required'],
            [['felhasznalo_id'], 'integer'],
            [['datum', 'kezdes', 'tavozas'], 'safe'],
            [['felhasznalo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Felhasznalo::className(), 'targetAttribute' => ['felhasznalo_id' => 'belepesi_azonosito']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'felhasznalo_id' => 'Felhasznalo ID',
            'datum' => 'Datum',
            'kezdes' => 'Kezdes',
            'tavozas' => 'Tavozas',
        ];
    }

    /**
     * Gets query for [[Felhasznalo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFelhasznalo()
    {
        return $this->hasOne(Felhasznalo::className(), ['belepesi_azonosito' => 'felhasznalo_id']);
    }
}
