<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsStatusesList;
use app\modules\terms\models\VML\TermsStatusesListVML;
use app\modules\terms\models\VML\TermsStatusesListSearchVML;
class TermsStatusesListSRL implements SRL {
    /**
     * @return array [TermsStatusesListSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsStatusesListSearchVML();
        $query = TermsStatusesList::find();
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
     * @return TermsStatusesListVML
     */
    public static function newViewModel() {
        $data = new TermsStatusesListVML();
        return $data;
    }
    /**
     * @param TermsStatusesListVML $data
     * @return void
     */
    public static function loadItems($data) {
    }
    /**
     * @param TermsStatusesListVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsStatusesList();
        $model->title = $data->title;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return TermsStatusesList     */
    public static function findModel($id) {
        return TermsStatusesList::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsStatusesListVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsStatusesListVML();
        $data->id = $model->id;
        $data->title = $model->title;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsStatusesListVML $data
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
     * @return TermsStatusesList[]
     */
    public static function getModels() {
        return TermsStatusesList::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'title');
    }
}