<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\users\models\VML\UsersStatusVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'Users Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="users-status-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>