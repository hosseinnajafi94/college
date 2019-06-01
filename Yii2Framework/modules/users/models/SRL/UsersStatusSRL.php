<?php
namespace app\modules\users\models\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\users\models\DAL\UsersStatus;
use app\modules\users\models\VML\UsersStatusVML;
class UsersStatusSRL {
    /**
     * @return ActiveDataProvider
     */
    public static function searchModel() {
        $query        = UsersStatus::find()->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return $dataProvider;
    }
    /**
     * @return UsersStatusVML
     */
    public static function newViewModel() {
        $data = new UsersStatusVML();
        return $data;
    }
    /**
     * @param UsersStatusVML $data
     * @param array $postParams
     * @return bool
     */
    public static function insert($data, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $model        = new UsersStatus();
        $model->title = $data->title;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @return UsersStatus
     */
    public static function findModel($id) {
        return UsersStatus::findOne($id);
    }
    /**
     * @param int $id
     * @return UsersStatusVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data        = new UsersStatusVML();
        $data->id    = $model->id;
        $data->title = $model->title;
        $data->model = $model;
        return $data;
    }
    /**
     * @param UsersStatusVML $data
     * @param array $postParams
     * @return bool
     */
    public static function update($data, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $model        = $data->model;
        $model->title = $data->title;
        return $model->save();
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function delete($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        return $model->delete() ? true : false;
    }
    /**
     * @return UsersStatus[]
     */
    public static function getModels() {
        return UsersStatus::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'title');
    }
}