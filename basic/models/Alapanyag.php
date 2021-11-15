<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alapanyag".
 *
 * @property int $id
 * @property string $nev
 * @property int $mennyiseg
 * @property string|null $mertekegyseg
 *
 * @property TermekOsszetevoi[] $termekOsszetevois
 */
class Alapanyag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alapanyag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nev', 'mennyiseg'], 'required'],
            ['nev', 'unique', 'message' => 'Létező alapanyag név!'],
            [['nev', 'mertekegyseg'], 'string'],
            [['mennyiseg'], 'integer'],
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
            'mennyiseg' => 'Mennyiseg',
            'mertekegyseg' => 'Mertekegyseg',
        ];
    }

    /**
     * Gets query for [[TermekOsszetevois]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTermekOsszetevois()
    {
        return $this->hasMany(TermekOsszetevoi::className(), ['alapanyag_id' => 'id']);
    }
}
