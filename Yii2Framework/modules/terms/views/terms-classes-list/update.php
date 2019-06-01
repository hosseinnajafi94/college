<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsClassesListVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Classes Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-classes-list-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>