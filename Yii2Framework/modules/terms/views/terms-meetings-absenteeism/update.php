<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsMeetingsAbsenteeismVML */
$this->title = Yii::t('terms', 'Terms Meetings Absenteeisms') . ' / ' . $model->id . ' / ' . Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Meetings Absenteeisms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-meetings-absenteeism-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>