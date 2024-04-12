<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_doc".
 *
 * @property int $id
 * @property int|null $car_id
 * @property int|null $doc_type_id
 * @property string|null $docname
 */
class CarDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'doc_type_id'], 'integer'],
            [['docname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'doc_type_id' => 'Doc Type ID',
            'docname' => 'Docname',
        ];
    }
}
