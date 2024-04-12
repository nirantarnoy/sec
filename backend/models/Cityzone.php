<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $plate_no
 * @property int|null $car_type_id
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Cityzone extends \common\models\Cityzone
{

    public static function findName($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }


}
