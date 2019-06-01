<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsMeetingsAbsenteeism;
use app\modules\terms\models\VML\TermsMeetingsAbsenteeismVML;
use app\modules\terms\models\VML\TermsMeetingsAbsenteeismSearchVML;
use app\modules\terms\models\SRL\TermsMeetingsSRL;
use app\modules\terms\models\SRL\TermsStudentsSRL;
class TermsMeetingsAbsenteeismSRL implements SRL {
    /**
     * @return array [TermsMeetingsAbsenteeismSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsMeetingsAbsenteeismSearchVML();
        $query = TermsMeetingsAbsenteeism::find();
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
        $query->andFilterWhere(['meeting_id' => $searchModel->meeting_id]);
        $query->andFilterWhere(['student_id' => $searchModel->student_id]);
        $query->andFilterWhere(['presence' => $searchModel->presence]);
        return [$searchModel, $dataProvider];
    }
    /**
     * @return TermsMeetingsAbsenteeismVML
     */
    public static function newViewModel() {
        $data = new TermsMeetingsAbsenteeismVML();
        return $data;
    }
    /**
     * @param TermsMeetingsAbsenteeismVML $data
     * @return void
     */
    public static function loadItems($data) {
        $data->meetings = TermsMeetingsSRL::getItems();
        $data->students = TermsStudentsSRL::getItems();
    }
    /**
     * @param TermsMeetingsAbsenteeismVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsMeetingsAbsenteeism();
        $model->meeting_id = $data->meeting_id;
        $model->student_id = $data->student_id;
        $model->presence = $data->presence;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return TermsMeetingsAbsenteeism     */
    public static function findModel($id) {
        return TermsMeetingsAbsenteeism::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsMeetingsAbsenteeismVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsMeetingsAbsenteeismVML();
        $data->id = $model->id;
        $data->meeting_id = $model->meeting_id;
        $data->student_id = $model->student_id;
        $data->presence = $model->presence;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsMeetingsAbsenteeismVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
        $model->meeting_id = $data->meeting_id;
        $model->student_id = $data->student_id;
        $model->presence = $data->presence;
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
     * @return TermsMeetingsAbsenteeism[]
     */
    public static function getModels() {
        return TermsMeetingsAbsenteeism::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'id');
    }
}