<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "napibevetel".
 *
 * @property int $id
 * @property string $datum
 * @property int $ar
 */
class Napibevetel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'napibevetel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datum', 'ar'], 'required'],
            [['datum'], 'safe'],
            [['ar'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datum' => 'Datum',
            'ar' => 'Ar',
        ];
    }
}
