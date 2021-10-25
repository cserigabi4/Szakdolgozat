<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendeglatohely".
 *
 * @property int $id
 * @property string $nev
 * @property string $adoszam
 * @property string $cim
 * @property string|null $telefon
 */
class Vendeglatohely extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendeglatohely';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nev', 'adoszam', 'cim'], 'required'],
            [['nev', 'adoszam', 'cim', 'telefon'], 'string'],
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
            'adoszam' => 'Adoszam',
            'cim' => 'Cim',
            'telefon' => 'Telefon',
        ];
    }
}
