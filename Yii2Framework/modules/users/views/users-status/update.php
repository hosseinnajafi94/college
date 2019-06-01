<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\users\models\VML\UsersStatusVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'Users Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="users-status-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>