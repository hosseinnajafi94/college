<?php
namespace app\modules\terms\models\SRL;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsStudents;
use app\modules\terms\models\VML\TermsStudentsVML;
use app\modules\users\models\SRL\UsersSRL;
use app\config\components\functions;
class TermsStudentsSRL implements SRL {
    /**
     * @return ActiveDataProvider
     */
    public static function searchModel() {
        $query        = TermsStudents::find();
        $query->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return $dataProvider;
    }
    /**
     * @return TermsStudentsVML
     */
    public static function newViewModel() {
        $data = new TermsStudentsVML();
        return $data;
    }
    /**
     * @param TermsStudentsVML $data
     * @return void
     */
    public static function loadItems($data) {
        $data->terms    = TermsSRL::getItems();
        $data->students = UsersSRL::getItems(4);
    }
    /**
     * @param TermsStudentsVML $data
     * @param array $postParams
     * @return bool
     */
    public static function insert($data, $postParams = []) {
        if (!$data->load($postParams)) {
            return false;
        }
        $data->register_date = functions::togdate($data->register_date);
        if (!$data->validate()) {
            return false;
        }
        $model                = new TermsStudents();
        $model->term_id       = $data->term_id;
        $model->student_id    = $data->student_id;
        $model->register_date = $data->register_date;
        $model->class_price   = $data->class_price;
        $model->book_price    = $data->book_price;
        $model->total_price   = $model->class_price + $model->book_price;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        $data->addErrors($model->getErrors());
        return false;
    }
    /**
     * @param int $id
     * @return TermsStudents
     */
    public static function findModel($id) {
        return TermsStudents::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsStudentsVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model === null) {
            return null;
        }
        $data                = new TermsStudentsVML();
        $data->id            = $model->id;
        $data->term_id       = $model->term_id;
        $data->student_id    = $model->student_id;
        $data->register_date = $model->register_date;
        $data->class_price   = $model->class_price;
        $data->book_price    = $model->book_price;
        $data->model         = $model;
        return $data;
    }
    /**
     * @param TermsStudentsVML $data
     * @param array $postParams
     * @return bool
     */
    public static function update($data, $postParams = []) {
        if (!$data->load($postParams)) {
            return false;
        }
        $data->register_date = functions::togdate($data->register_date);
        if (!$data->validate()) {
            return false;
        }
        $model                = $data->model;
        $model->term_id       = $data->term_id;
        $model->student_id    = $data->student_id;
        $model->register_date = $data->register_date;
        $model->class_price   = $data->class_price;
        $model->book_price    = $data->book_price;
        $model->total_price   = $model->class_price + $model->book_price;
        if ($model->save()) {
            return true;
        }
        $data->addErrors($model->getErrors());
        return false;
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function delete($id) {
        $model = self::findModel($id);
        if ($model === null) {
            return null;
        }
        return $model->delete() ? true : false;
    }
    /**
     * @return TermsStudents[]
     */
    public static function getModels() {
        return TermsStudents::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', function ($model) {
            $student = $model->student;
            return "# $student->id / $student->fname $student->lname";
        });
    }
}