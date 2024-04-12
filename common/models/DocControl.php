<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_control".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $doc_file
 * @property int|null $company_id
 * @property string|null $start_date
 * @property string|null $exp_date
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 */
class DocControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','doc_file'],'required'],
            [['company_id', 'status', 'created_at', 'created_by'], 'integer'],
            [['start_date', 'exp_date'], 'safe'],
            [['name', 'description', 'doc_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อเอกสาร',
            'description' => 'รายละเอียด',
            'doc_file' => 'ไฟล์',
            'company_id' => 'บริษัท',
            'start_date' => 'วันที่เริ่มเอกสาร',
            'exp_date' => 'วันที่หมดอายุ',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
