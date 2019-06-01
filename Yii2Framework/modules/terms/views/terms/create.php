<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>