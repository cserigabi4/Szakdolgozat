<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "felhasznalo".
 *
 * @property int $belepesi_azonosito
 * @property string $nev
 * @property string $jelszo
 * @property string $jog
 * @property string|null $szuletesi_ido
 * @property string|null $lakcim
 * @property string|null $telefon
 * @property string|null $ado_azonosito
 *
 * @property Beosztas[] $beosztas
 * @property DolgozoFogyasztas[] $dolgozoFogyasztas
 * @property NapiLista[] $napiListas
 * @property NapiLista[] $napiListas0
 */
class Felhasznalo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'felhasznalo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nev', 'jelszo', 'jog'], 'required'],
            [['nev', 'jelszo', 'jog', 'lakcim', 'telefon', 'ado_azonosito'], 'string'],
            [['szuletesi_ido'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'belepesi_azonosito' => 'Belepesi Azonosito',
            'nev' => 'Nev',
            'jelszo' => 'Jelszo',
            'jog' => 'Jog',
            'szuletesi_ido' => 'Szuletesi Ido',
            'lakcim' => 'Lakcim',
            'telefon' => 'Telefon',
            'ado_azonosito' => 'Ado Azonosito',
        ];
    }

    /**
     * Gets query for [[Beosztas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBeosztas()
    {
        return $this->hasMany(Beosztas::className(), ['felhasznalo_id' => 'belepesi_azonosito']);
    }

    /**
     * Gets query for [[DolgozoFogyasztas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDolgozoFogyasztas()
    {
        return $this->hasMany(DolgozoFogyasztas::className(), ['felhasznalo_id' => 'belepesi_azonosito']);
    }

    /**
     * Gets query for [[NapiListas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNapiListas()
    {
        return $this->hasMany(NapiLista::className(), ['felhasznalo_id' => 'belepesi_azonosito']);
    }

    /**
     * Gets query for [[NapiListas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNapiListas0()
    {
        return $this->hasMany(NapiLista::className(), ['felvette' => 'belepesi_azonosito']);
    }
}
