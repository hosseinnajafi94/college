<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>