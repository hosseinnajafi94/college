<?php
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\DAL\TermsPayments */
$student = $model->student;
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $student->fname . ' ' . $student->lname;
?>
<div class="terms-payments-view">
    <div class="box">
        <div class="box-header"><?= $student->fname . ' ' . $student->lname ?></div>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method' => 'post']]) ?>
        </p>
        <div class="table-responsive">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'student_id',
                    'price',
                ],
            ]) ?>
        </div>
    </div>
</div>