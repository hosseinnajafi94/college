<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsMeetingsVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-meetings-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>