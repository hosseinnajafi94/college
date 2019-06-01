<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this yii\web\View */
/* @var $searchModel \app\modules\terms\models\VML\TermsMeetingsAbsenteeismSearchVML */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('terms', 'Terms Meetings Absenteeisms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terms-meetings-absenteeism-index">
    <div class="blocks">
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
                    'meeting_id',
                    'student_id',
                    'presence',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]) ?>
        </div>
    </div>
</div>