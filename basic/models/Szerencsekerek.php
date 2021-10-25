<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "szerencsekerek".
 *
 * @property int $id
 * @property string $nev
 * @property string $ertek
 */
class Szerencsekerek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'szerencsekerek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nev', 'ertek'], 'required'],
            [['nev', 'ertek'], 'string'],
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
            'ertek' => 'Ertek',
        ];
    }
}
