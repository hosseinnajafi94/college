<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this         \yii\web\View */
/* @var $searchModel  \app\modules\terms\models\VML\TermsStudentsSearchVML */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('terms', 'Terms Students');
?>
<div class="terms-students-index">
    <div class="box">
        <div class="box-header"><?= Yii::t('terms', 'Terms Students') ?></div>
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
                    [
                        'attribute' => 'term_id',
                        'pattern'   => '{name}'
                    ],
                    [
                        'attribute' => 'student_id',
                        'pattern'   => '{fname} {lname}'
                    ],
                    'register_date:jdate',
                    'class_price:toman',
                    'book_price:toman',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]) ?>
        </div>
    </div>
</div>