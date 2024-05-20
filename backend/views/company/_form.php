<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="company-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <input type="hidden" class="remove-list" name="remove_list" value="">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'taxid')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>


        <!-- <?= $form->field($model, 'status')->textInput() ?> -->
        <?php echo $form->field($model, 'show_expired_date')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>



        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <form id="form-delete-doc" action="<?= \yii\helpers\Url::to(['company/removedoc'], true) ?>" method="post">
        <input type="hidden" name="company_id" value="<?= $model->id ?>">
        <input type="hidden" class="company-doc-delete" name="doc_name" value="">
    </form>

<?php
$js = <<<JS
var removelist = [];
$(function (){
    
});
function addline(e){
    var tr = $("#table-list tbody tr:last");
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find(".line-doc-name").val("");
                    clone.find(".line-file-name").val("");
                    
                    clone.attr("data-var", "");
                    clone.find('.rec-id').val("0");
                    
                    tr.after(clone);
     
}
function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                   // $(this).find(".line-prod-photo").attr('src', '');
                    $(this).find(".line-file-name").val('');
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
    }
function removedoc(e){
    var doc_name = e.attr("data-var");
    $(".company-doc-delete").val(doc_name);
    if(doc_name != ''){
        $("form#form-delete-doc").submit();
    }
}
JS;
$this->registerJs($js, static::POS_END);

?>