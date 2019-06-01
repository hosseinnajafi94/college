<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsPaymentsVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-payments-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>