<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsStudents;
use app\modules\terms\models\VML\TermsStudentsVML;
use app\modules\terms\models\VML\TermsStudentsSearchVML;
use app\modules\terms\models\SRL\TermsSRL;
use app\modules\users\models\SRL\UsersSRL;
class TermsStudentsSRL implements SRL {
    /**
     * @return array [TermsStudentsSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsStudentsSearchVML();
        $query = TermsStudents::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['defaultPageSize' => 10]
        ]);
        $searchModel->load(Yii::$app->request->queryParams);
        self::loadItems($searchModel);
        if (!$searchModel->validate()) {
            $query->where('0=1');
            return [$searchModel, $dataProvider];
        }
        $query->andFilterWhere(['term_id' => $searchModel->term_id]);
        $query->andFilterWhere(['student_id' => $searchModel->student_id]);
        $query->andFilterWhere(['register_date' => $searchModel->register_date]);
        $query->andFilterWhere(['class_price' => $searchModel->class_price]);
        $query->andFilterWhere(['book_price' => $searchModel->book_price]);
        return [$searchModel, $dataProvider];
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
        $data->terms = TermsSRL::getItems();
        $data->students = UsersSRL::getItems(4);
    }
    /**
     * @param TermsStudentsVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsStudents();
        $model->term_id = $data->term_id;
        $model->student_id = $data->student_id;
        $model->register_date = $data->register_date;
        $model->class_price = $data->class_price;
        $model->book_price = $data->book_price;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return TermsStudents     */
    public static function findModel($id) {
        return TermsStudents::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsStudentsVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsStudentsVML();
        $data->id = $model->id;
        $data->term_id = $model->term_id;
        $data->student_id = $model->student_id;
        $data->register_date = $model->register_date;
        $data->class_price = $model->class_price;
        $data->book_price = $model->book_price;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsStudentsVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
        $model->term_id = $data->term_id;
        $model->student_id = $data->student_id;
        $model->register_date = $data->register_date;
        $model->class_price = $data->class_price;
        $model->book_price = $data->book_price;
        return $model->save();
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function delete($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return false;
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
        return ArrayHelper::map($models, 'id', 'id');
    }
}