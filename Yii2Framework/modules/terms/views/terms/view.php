<?php
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model \app\modules\terms\models\DAL\Terms */
$this->title = Yii::t('terms', 'Terms') . ' / ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="terms-view">
    <div class="box">
        <div class="box-header"><?= $model->name ?></div>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method' => 'post']]) ?>
        </p>
        <div class="table-responsive">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'attribute' => 'book_id',
                        'pattern'   => '{name}',
                        'url'       => ['/terms/terms-books-list/view', 'id' => '{id}']
                    ],
                    [
                        'attribute' => 'teacher_id',
                        'pattern'   => '{fname} {lname}',
                        'url'       => ['/users/users/view', 'id' => '{id}']
                    ],
                    [
                        'attribute' => 'class_id',
                        'pattern'   => '{title}',
                        'url'       => ['/terms/terms-classes-list/view', 'id' => '{id}']
                    ],
                    // 'status_id',
                    'teacher_price:toman',
                    'term_price:toman',
                    'book_price:toman',
                    'total_price:toman',
                    'start_date:jdate',
                    'end_date:jdate',
                    'start_time',
                    'end_time',
                    'meetings_count',
                    'sa:bool',
                    'su:bool',
                    'mo:bool',
                    'tu:bool',
                    'we:bool',
                    'th:bool',
                ],
            ]) ?>
        </div>
    </div>
</div>