<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsClassesListVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Classes Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-classes-list-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>