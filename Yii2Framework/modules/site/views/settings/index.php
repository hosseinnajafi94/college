<?php
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\site\models\DAL\SiteSettings */
$this->params['breadcrumbs'][] = Yii::t('site', 'Site Settings');
?>
<div class="site-settings-index">
    <div class="box">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-header"><?= Yii::t('site', 'Site Settings') ?></div>
        <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'logo')->fileInput() ?>
                <?= $form->field($model, 'favicon')->fileInput()->hint('سایز تصویر 16 پیکسل در 16 پیکسل') ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>