<?php
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\DAL\TermsStudents */
$student = $model->student;
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $student->fname . ' ' . $student->lname;
?>
<div class="terms-students-view">
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
                ],
            ]) ?>
        </div>
    </div>
</div>