<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form \app\config\widgets\ActiveForm */
/* @var $model \app\modules\terms\models\VML\TermsVML */
?>
<div class="terms-form">
    <div class="box">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header"><?= Yii::t('app', $model->id ? 'Update' : 'Create') ?></div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'book_id')->select2($model->books) ?>
                <?= $form->field($model, 'teacher_id')->select2($model->teachers) ?>
                <?= $form->field($model, 'class_id')->select2($model->classes) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'teacher_price')->textInput(['dir' => 'ltr']) ?>
                <?= $form->field($model, 'term_price')->textInput(['dir' => 'ltr']) ?>
                <?= $form->field($model, 'book_price')->textInput(['dir' => 'ltr']) ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'start_date')->textInput(['dir' => 'ltr', 'class' => 'form-control input-sm text-center datePicker']) ?>
                <?= $form->field($model, 'end_date')->textInput(['dir' => 'ltr', 'class' => 'form-control input-sm text-center datePicker']) ?>
                <?= $form->field($model, 'start_time')->textInput(['dir' => 'ltr', 'class' => 'form-control input-sm text-center timePicker']) ?>
                <?= $form->field($model, 'end_time')->textInput(['dir' => 'ltr', 'class' => 'form-control input-sm text-center timePicker']) ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'meetings_count')->textInput(['dir' => 'ltr']) ?>
                <?= $form->field($model, 'sa')->checkbox() ?>
                <?= $form->field($model, 'su')->checkbox() ?>
                <?= $form->field($model, 'mo')->checkbox() ?>
                <?= $form->field($model, 'tu')->checkbox() ?>
                <?= $form->field($model, 'we')->checkbox() ?>
                <?= $form->field($model, 'th')->checkbox() ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$this->registerCss('
    .checkbox label {padding: 0;}
    .checkbox input[type="checkbox"] {visibility: visible;position: relative;top: 4px;margin: 0;}
');
$this->registerJs("
$('#termsvml-book_id').change(function () {
    var id = $(this).val();
    if (id) {
        ajaxpost('" . Url::to(['/terms/terms-books-list/get-price']) . "', {id}, function (result) {
            if (validResult(result)) {
                $('#termsvml-book_price').val(result.price);
            }
        });
    }
});
");