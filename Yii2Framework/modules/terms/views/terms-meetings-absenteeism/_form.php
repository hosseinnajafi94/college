<?php
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form \app\config\widgets\ActiveForm */
/* @var $model \app\modules\terms\models\VML\TermsMeetingsAbsenteeismVML */
?>
<div class="terms-meetings-absenteeism-form">
    <div class="blocks">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'meeting_id')->dropDownList($model->meetings) ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'student_id')->dropDownList($model->students) ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'presence')->textInput() ?>
            </div>
        </div>
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>