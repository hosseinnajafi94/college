<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsMeetingsAbsenteeismVML */
$this->title = Yii::t('terms', 'Terms Meetings Absenteeisms') . ' / ' . Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Meetings Absenteeisms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-meetings-absenteeism-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>