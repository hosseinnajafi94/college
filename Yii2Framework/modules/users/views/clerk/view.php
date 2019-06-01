<?php
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this  \yii\web\View */
/* @var $model \app\modules\users\models\DAL\Users */
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->fname . ' ' . $model->lname;
?>
<div class="users-view">
    <div class="box">
        <div class="box-header"><?= $model->fname . ' ' . $model->lname ?></div>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method' => 'post']]) ?>
            <?= Html::a(Yii::t('users', 'Reset Password'), ['reset-password', 'id' => $model->id], ['class' => 'btn btn-sm btn-default', 'data' => ['confirm' => Yii::t('users', 'Are you sure?'), 'method' => 'post']]) ?>
        </p>
        <div class="table-responsive">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'fname',
                    'lname',
                    'mobile',
                    'phone',
                    'email:email',
                    'address',
                ],
            ]) ?>
        </div>
    </div>
</div>