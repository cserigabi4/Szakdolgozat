<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "napi_lista".
 *
 * @property int $id
 * @property int $felhasznalo_id
 * @property string $nev
 * @property string $leiras
 * @property int $felvette
 * @property string $fontossag
 * @property string $allapot
 *
 * @property Felhasznalo $felhasznalo
 * @property Felhasznalo $felvette0
 */
class NapiLista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'napi_lista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['felhasznalo_id', 'nev', 'leiras', 'felvette', 'fontossag', 'allapot'], 'required'],
            [['felhasznalo_id', 'felvette'], 'integer'],
            [['nev', 'leiras', 'fontossag', 'allapot'], 'string'],
            [['felhasznalo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Felhasznalo::className(), 'targetAttribute' => ['felhasznalo_id' => 'belepesi_azonosito']],
            [['felvette'], 'exist', 'skipOnError' => true, 'targetClass' => Felhasznalo::className(), 'targetAttribute' => ['felvette' => 'belepesi_azonosito']],
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
            'nev' => 'Nev',
            'leiras' => 'Leiras',
            'felvette' => 'Felvette',
            'fontossag' => 'Fontossag',
            'allapot' => 'Allapot',
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
     * Gets query for [[Felvette0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFelvette0()
    {
        return $this->hasOne(Felhasznalo::className(), ['belepesi_azonosito' => 'felvette']);
    }
}
