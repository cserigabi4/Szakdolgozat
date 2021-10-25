<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asztal".
 *
 * @property int $id
 * @property string|null $qr
 * @property int|null $x
 * @property int|null $y
 *
 * @property Rendeles[] $rendeles
 */
class Asztal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asztal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['x', 'y'], 'integer'],
            [['qr'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qr' => 'Qr',
            'x' => 'X',
            'y' => 'Y',
        ];
    }

    /**
     * Gets query for [[Rendeles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendeles()
    {
        return $this->hasMany(Rendeles::className(), ['asztal_id' => 'id']);
    }
}
