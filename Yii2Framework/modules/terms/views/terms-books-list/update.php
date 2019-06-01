<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsBooksListVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Books Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-books-list-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>