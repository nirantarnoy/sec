<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cashadvance $model */

$this->title = 'บันทึกรับจ่าย';
$this->params['breadcrumbs'][] = ['label' => 'Cash Advances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashadvance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
