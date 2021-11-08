<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rendelt_termek".
 *
 * @property int $id
 * @property int $rendeles_id
 * @property int $termek_id
 * @property boolean $torolt
 * @property Rendeles $rendeles
 * @property Termek $termek
 */
class RendeltTermek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rendelt_termek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rendeles_id', 'termek_id'], 'required'],
            [['rendeles_id', 'termek_id'], 'integer'],
            [['rendeles_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rendeles::className(), 'targetAttribute' => ['rendeles_id' => 'id']],
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
            'rendeles_id' => 'Rendeles ID',
            'termek_id' => 'Termek ID',
        ];
    }

    /**
     * Gets query for [[Rendeles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendeles()
    {
        return $this->hasOne(Rendeles::className(), ['id' => 'rendeles_id']);
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
