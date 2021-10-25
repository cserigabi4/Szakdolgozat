<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "termek_osszetevoi".
 *
 * @property int $termek_id
 * @property int $alapanyag_id
 *
 * @property Alapanyag $alapanyag
 * @property Termek $termek
 */
class TermekOsszetevoi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'termek_osszetevoi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['termek_id', 'alapanyag_id'], 'required'],
            [['termek_id', 'alapanyag_id'], 'integer'],
            [['alapanyag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alapanyag::className(), 'targetAttribute' => ['alapanyag_id' => 'id']],
            [['termek_id'], 'exist', 'skipOnError' => true, 'targetClass' => Termek::className(), 'targetAttribute' => ['termek_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'termek_id' => 'Termek ID',
            'alapanyag_id' => 'Alapanyag ID',
        ];
    }

    /**
     * Gets query for [[Alapanyag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlapanyag()
    {
        return $this->hasOne(Alapanyag::className(), ['id' => 'alapanyag_id']);
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
