<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contact_info".
 *
 * @property int $id
 * @property int|null $party_type
 * @property int|null $party_id
 * @property int|null $type_id
 * @property string|null $contact_no
 * @property int|null $is_primary
 * @property string|null $contact_name
 */
class ContactInfo extends \common\models\ContactInfo
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
            [['party_type', 'party_id', 'type_id', 'is_primary'], 'integer'],
            [['contact_no', 'contact_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_type' => 'Party Type',
            'party_id' => 'Party ID',
            'type_id' => 'Type ID',
            'contact_no' => 'Contact No',
            'is_primary' => 'Is Primary',
            'contact_name' => 'Contact Name',
        ];
    }
}
