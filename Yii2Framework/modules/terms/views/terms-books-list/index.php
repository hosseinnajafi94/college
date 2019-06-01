<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this         \yii\web\View */
/* @var $searchModel  \app\modules\terms\models\VML\TermsBooksListSearchVML */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('terms', 'Terms Books Lists');
?>
<div class="terms-books-list-index">
    <div class="box">
        <div class="box-header"><?= Yii::t('terms', 'Terms Books Lists') ?></div>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Search Panel'), null, ['class' => 'btn btn-sm btn-primary btn-search-panel']) ?>
        </p>
        <?= $this->render('_search', ['model' => $searchModel]) ?>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'price:toman',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]) ?>
        </div>
    </div>
</div>