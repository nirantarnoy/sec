<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_info".
 *
 * @property int $id
 * @property int|null $party_ref_id
 * @property int|null $party_type_id
 * @property string|null $dept_name
 * @property string|null $contact_name
 * @property int|null $status
 */
class ContactInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['party_ref_id', 'party_type_id', 'status'], 'integer'],
            [['dept_name', 'contact_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_ref_id' => 'Party Ref ID',
            'party_type_id' => 'Party Type ID',
            'dept_name' => 'Dept Name',
            'contact_name' => 'Contact Name',
            'status' => 'Status',
        ];
    }
}
