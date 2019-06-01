<?php
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model \app\modules\terms\models\DAL\TermsMeetingsAbsenteeism */
$this->title = Yii::t('terms', 'Terms Meetings Absenteeisms') . ' / ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Meetings Absenteeisms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="terms-meetings-absenteeism-view">
    <div class="blocks">
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method' => 'post']]) ?>
        </p>
        <div class="table-responsive">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'meeting_id',
                    'student_id',
                    'presence',
                ],
            ]) ?>
        </div>
    </div>
</div>