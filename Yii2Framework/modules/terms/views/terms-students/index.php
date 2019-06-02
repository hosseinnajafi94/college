<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this  \yii\web\View */
/* @var $model \yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('terms', 'Terms Students');
?>
<div class="terms-students-index">
    <div class="box">
        <div class="box-header"><?= Yii::t('terms', 'Terms Students') ?></div>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </p>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $model,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'term_id',
                        'pattern'   => '# {id} / {name}',
                        'url' => ['/terms/terms/view', 'id' => '{id}']
                    ],
                    [
                        'attribute' => 'student_id',
                        'pattern'   => '# {id} / {fname} {lname}',
                        'url' => ['/users/users/view', 'id' => '{id}']
                    ],
                    'register_date:jdate',
                    //'class_price:toman',
                    //'book_price:toman',
                    //'total_price:toman',
                    ['class' => 'app\config\widgets\ActionColumn'],
                ],
            ]) ?>
        </div>
    </div>
</div>