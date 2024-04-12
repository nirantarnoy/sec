<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_doc".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $doc_name
 * @property string|null $description
 */
class CompanyDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['doc_name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'doc_name' => 'Doc Name',
            'description' => 'Description',
        ];
    }
}
