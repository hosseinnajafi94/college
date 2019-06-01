<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsClassesList;
use app\modules\terms\models\VML\TermsClassesListVML;
use app\modules\terms\models\VML\TermsClassesListSearchVML;
class TermsClassesListSRL implements SRL {
    /**
     * @return array [TermsClassesListSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsClassesListSearchVML();
        $query = TermsClassesList::find();
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
        $query->andFilterWhere(['like', 'title', $searchModel->title]);
        return [$searchModel, $dataProvider];
    }
    /**
     * @return TermsClassesListVML
     */
    public static function newViewModel() {
        $data = new TermsClassesListVML();
        return $data;
    }
    /**
     * @param TermsClassesListVML $data
     * @return void
     */
    public static function loadItems($data) {
    }
    /**
     * @param TermsClassesListVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsClassesList();
        $model->title = $data->title;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @return TermsClassesList
     */
    public static function findModel($id) {
        return TermsClassesList::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsClassesListVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsClassesListVML();
        $data->id = $model->id;
        $data->title = $model->title;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsClassesListVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
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
            return false;
        }
        return $model->delete() ? true : false;
    }
    /**
     * @return TermsClassesList[]
     */
    public static function getModels() {
        return TermsClassesList::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'title');
    }
}