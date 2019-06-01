<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsPaymentsVML */
$student = $model->model->student;
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $student->fname . ' ' . $student->lname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-payments-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>