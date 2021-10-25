<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rendeles".
 *
 * @property int $id
 * @property int $asztal_id
 * @property int $ar
 * @property int $allapot
 * @property int|null $kedvezmeny
 *
 * @property Asztal $asztal
 * @property RendeltTermek[] $rendeltTermeks
 */
class Rendeles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rendeles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asztal_id', 'ar', 'allapot'], 'required'],
            [['asztal_id', 'ar', 'allapot', 'kedvezmeny'], 'integer'],
            [['asztal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asztal::className(), 'targetAttribute' => ['asztal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asztal_id' => 'Asztal ID',
            'ar' => 'Ar',
            'allapot' => 'Allapot',
            'kedvezmeny' => 'Kedvezmeny',
        ];
    }

    /**
     * Gets query for [[Asztal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsztal()
    {
        return $this->hasOne(Asztal::className(), ['id' => 'asztal_id']);
    }

    /**
     * Gets query for [[RendeltTermeks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendeltTermeks()
    {
        return $this->hasMany(RendeltTermek::className(), ['rendeles_id' => 'id']);
    }
}
