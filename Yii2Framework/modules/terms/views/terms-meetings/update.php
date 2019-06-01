<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsMeetingsVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->model->term->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-meetings-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>