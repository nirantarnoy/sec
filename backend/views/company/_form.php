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

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'social_base_price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'social_deduct_per')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <label for="">อัพเดทล่าสุด</label>
                <input type="text" class="form-control" readonly value="<?=\backend\models\Company::findSocialLastUpdate($model->id)?>">
            </div>
        </div>



        <!-- <?= $form->field($model, 'status')->textInput() ?> -->
        <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

        <?php if ($model_line_doc == null): ?>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered" id="table-list">
                        <tbody>
                        <tr>
                            <td>
                                <input type="hidden" class="rec-id" name="rec_id[]" value="0">
                                <input type="text" class="form-control line-doc-name" name="line_doc_name[]" value="">
                            </td>
                            <td>
                                <input type="file" class="line-file-name" name="line_file_name[]">
                            </td>
                            <td>
                                <div class="btn btn-danger" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <div class="btn btn-primary" onclick="addline($(this))">เพิ่ม</div>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered" id="table-list">
                        <tbody>
                        <?php foreach ($model_line_doc as $val): ?>
                            <tr data-var="<?=$val->id?>">
                                <td>
                                    <input type="hidden" class="rec-id" name="rec_id[]" value="<?= $val->id ?>">
                                    <input type="text" class="form-control line-doc-name" name="line_doc_name[]"
                                           value="<?= $val->description ?>">
                                </td>
                                <td>
                                    <a href="<?= \Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/company_doc/' . $val->doc_name ?>"
                                       target="_blank">ดูเอกสาร</a></td>
                                </td>
                                <td>
                                    <div class="btn btn-danger" onclick="removeline($(this))">ลบ</div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>
                                <input type="hidden" class="rec-id" name="rec_id[]" value="0">
                                <input type="text" class="form-control line-doc-name" name="line_doc_name[]" value="">
                            </td>
                            <td>
                                <input type="file" class="line-file-name" name="line_file_name[]">
                            </td>
                            <td>
                                <div class="btn btn-danger" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <div class="btn btn-primary" onclick="addline($(this))">เพิ่ม</div>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>

        <?php endif; ?>


        <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->

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