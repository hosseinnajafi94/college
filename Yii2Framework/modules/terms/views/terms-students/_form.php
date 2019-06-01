<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this  \yii\web\View */
/* @var $form  \app\config\widgets\ActiveForm */
/* @var $model \app\modules\terms\models\VML\TermsStudentsVML */
?>
<div class="terms-students-form">
    <div class="box">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header"><?= Yii::t('app', $model->id ? 'Update' : 'Create') ?></div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'term_id')->select2($model->terms) ?>
                <?= $form->field($model, 'student_id')->select2($model->students) ?>
                <?= $form->field($model, 'register_date')->textInput(['dir' => 'ltr', 'class' => 'form-control input-sm text-center datePicker']) ?>
                <?= $form->field($model, 'class_price')->textInput(['dir' => 'ltr']) ?>
                <?= $form->field($model, 'book_price')->textInput(['dir' => 'ltr']) ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$this->registerJs("
$('#termsstudentsvml-term_id').change(function () {
    var id = $(this).val();
    if (id) {
        ajaxpost('" . Url::to(['/terms/terms/get-price']) . "', {id}, function (result) {
            if (validResult(result)) {
                $('#termsstudentsvml-class_price').val(result.termPrice);
                $('#termsstudentsvml-book_price').val(result.bookPrice);
            }
        });
    }
});
");