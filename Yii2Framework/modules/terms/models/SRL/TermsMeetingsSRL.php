<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsMeetings;
use app\modules\terms\models\VML\TermsMeetingsVML;
use app\modules\terms\models\VML\TermsMeetingsSearchVML;
use app\modules\terms\models\SRL\TermsSRL;
use app\modules\users\models\SRL\UsersSRL;
class TermsMeetingsSRL implements SRL {
    /**
     * @return array [TermsMeetingsSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsMeetingsSearchVML();
        $query = TermsMeetings::find();
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
        $query->andFilterWhere(['teacher_id' => $searchModel->teacher_id]);
        $query->andFilterWhere(['date' => $searchModel->date]);
        return [$searchModel, $dataProvider];
    }
    /**
     * @return TermsMeetingsVML
     */
    public static function newViewModel() {
        $data = new TermsMeetingsVML();
        return $data;
    }
    /**
     * @param TermsMeetingsVML $data
     * @return void
     */
    public static function loadItems($data) {
        $data->terms = TermsSRL::getItems();
        $data->teachers = UsersSRL::getItems([3, 1]);
    }
    /**
     * @param TermsMeetingsVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsMeetings();
        $model->term_id = $data->term_id;
        $model->teacher_id = $data->teacher_id;
        $model->date = $data->date;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return TermsMeetings     */
    public static function findModel($id) {
        return TermsMeetings::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsMeetingsVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsMeetingsVML();
        $data->id = $model->id;
        $data->term_id = $model->term_id;
        $data->teacher_id = $model->teacher_id;
        $data->date = $model->date;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsMeetingsVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
        $model->term_id = $data->term_id;
        $model->teacher_id = $data->teacher_id;
        $model->date = $data->date;
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
     * @return TermsMeetings[]
     */
    public static function getModels() {
        return TermsMeetings::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'id');
    }
}