<?php
namespace app\modules\users\models\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\users\models\DAL\UsersGroups;
use app\modules\users\models\VML\UsersGroupsVML;
class UsersGroupsSRL {
    /**
     * @return ActiveDataProvider
     */
    public static function searchModel() {
        $query        = UsersGroups::find()->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return $dataProvider;
    }
    /**
     * @return UsersGroupsVML
     */
    public static function newViewModel() {
        $data = new UsersGroupsVML();
        return $data;
    }
    /**
     * @param UsersGroupsVML $data
     * @param array $postParams
     * @return bool
     */
    public static function insert($data, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $model        = new UsersGroups();
        $model->title = $data->title;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @return UsersGroups
     */
    public static function findModel($id) {
        return UsersGroups::findOne($id);
    }
    /**
     * @param int $id
     * @return UsersGroupsVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data        = new UsersGroupsVML();
        $data->id    = $model->id;
        $data->title = $model->title;
        $data->model = $model;
        return $data;
    }
    /**
     * @param UsersGroupsVML $data
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
     * @return UsersGroups[]
     */
    public static function getModels() {
        return UsersGroups::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'title');
    }
}