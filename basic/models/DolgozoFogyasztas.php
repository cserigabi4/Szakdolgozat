<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dolgozo_fogyasztas".
 *
 * @property int $id
 * @property int $felhasznalo_id
 * @property int $termek_id
 *
 * @property Felhasznalo $felhasznalo
 * @property Termek $termek
 */
class DolgozoFogyasztas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dolgozo_fogyasztas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['felhasznalo_id', 'termek_id'], 'required'],
            [['felhasznalo_id', 'termek_id'], 'integer'],
            [['felhasznalo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Felhasznalo::className(), 'targetAttribute' => ['felhasznalo_id' => 'belepesi_azonosito']],
            [['termek_id'], 'exist', 'skipOnError' => true, 'targetClass' => Termek::className(), 'targetAttribute' => ['termek_id' => 'id']],
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
            'termek_id' => 'Termek ID',
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

    /**
     * Gets query for [[Termek]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTermek()
    {
        return $this->hasOne(Termek::className(), ['id' => 'termek_id']);
    }
}
