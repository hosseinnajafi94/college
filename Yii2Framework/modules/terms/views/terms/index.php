<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this  \yii\web\View */
/* @var $model \yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('terms', 'Terms');
?>
<div class="terms-index">
    <div class="box">
        <div class="box-header"><?= Yii::t('terms', 'Terms') ?></div>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </p>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $model,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'term_price:toman',
                    'book_price:toman',
                    'total_price:toman',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]) ?>
        </div>
    </div>
</div>