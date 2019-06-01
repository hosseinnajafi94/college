<?php
/* @var $this  \yii\web\View */
/* @var $model \app\modules\terms\models\VML\TermsStudentsVML */
$student = $model->model->student;
$this->params['breadcrumbs'][] = ['label' => Yii::t('terms', 'Terms Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $student->fname . ' ' . $student->lname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="terms-students-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>