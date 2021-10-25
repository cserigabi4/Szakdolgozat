<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jelenletiiv".
 *
 * @property int $id
 * @property int $felhasznalo_id
 * @property string $erkezet
 * @property string $tavozott
 */
class Jelenletiiv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jelenletiiv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['felhasznalo_id', 'erkezet', 'tavozott'], 'required'],
            [['felhasznalo_id'], 'integer'],
            [['erkezet', 'tavozott'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'felhasznalo_id' => 'Felhasznalo ID',
            'erkezet' => 'Erkezet',
            'tavozott' => 'Tavozott',
        ];
    }
}
