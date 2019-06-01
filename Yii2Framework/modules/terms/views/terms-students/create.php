<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsStudentsVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-students-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>