<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsBooksListVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Books Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="terms-books-list-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>