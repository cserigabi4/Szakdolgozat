<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "termek".
 *
 * @property int $id
 * @property int $kategoria_id
 * @property int $ar
 * @property string $nev
 *
 * @property DolgozoFogyasztas[] $dolgozoFogyasztas
 * @property Kategoria $kategoria
 * @property RendeltTermek[] $rendeltTermeks
 * @property TermekOsszetevoi[] $termekOsszetevois
 */
class Termek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'termek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategoria_id', 'ar'], 'required'],
            [['kategoria_id', 'ar'], 'integer'],
            [['kategoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategoria::className(), 'targetAttribute' => ['kategoria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategoria_id' => 'Kategoria ID',
            'ar' => 'Ar',
        ];
    }

    /**
     * Gets query for [[DolgozoFogyasztas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDolgozoFogyasztas()
    {
        return $this->hasMany(DolgozoFogyasztas::className(), ['termek_id' => 'id']);
    }

    /**
     * Gets query for [[Kategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategoria()
    {
        return $this->hasOne(Kategoria::className(), ['id' => 'kategoria_id']);
    }

    /**
     * Gets query for [[RendeltTermeks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendeltTermeks()
    {
        return $this->hasMany(RendeltTermek::className(), ['termek_id' => 'id']);
    }

    /**
     * Gets query for [[TermekOsszetevois]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTermekOsszetevois()
    {
        return $this->hasMany(TermekOsszetevoi::className(), ['termek_id' => 'id']);
    }
}
