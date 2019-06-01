<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsStatusesListVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Statuses Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-statuses-list-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>