<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ertekelesek".
 *
 * @property int $id
 * @property string|null $nev
 * @property string $leiras
 * @property int $pont
 */
class Ertekelesek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ertekelesek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nev', 'leiras'], 'string'],
            [['leiras', 'pont'], 'required'],
            [['pont'], 'integer'],
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
            'leiras' => 'Leiras',
            'pont' => 'Pont',
        ];
    }
}
