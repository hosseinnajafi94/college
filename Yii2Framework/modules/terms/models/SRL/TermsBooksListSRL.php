<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsBooksList;
use app\modules\terms\models\VML\TermsBooksListVML;
use app\modules\terms\models\VML\TermsBooksListSearchVML;
class TermsBooksListSRL implements SRL {
    /**
     * @return array [TermsBooksListSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsBooksListSearchVML();
        $query = TermsBooksList::find();
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
        $query->andFilterWhere(['price' => $searchModel->price]);
        $query->andFilterWhere(['like', 'name', $searchModel->name]);
        return [$searchModel, $dataProvider];
    }
    /**
     * @return TermsBooksListVML
     */
    public static function newViewModel() {
        $data = new TermsBooksListVML();
        return $data;
    }
    /**
     * @param TermsBooksListVML $data
     * @return void
     */
    public static function loadItems($data) {
    }
    /**
     * @param TermsBooksListVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsBooksList();
        $model->name = $data->name;
        $model->price = $data->price;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @return TermsBooksList
     */
    public static function findModel($id) {
        return TermsBooksList::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsBooksListVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsBooksListVML();
        $data->id = $model->id;
        $data->name = $model->name;
        $data->price = $model->price;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsBooksListVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
        $model->name = $data->name;
        $model->price = $data->price;
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
     * @return TermsBooksList[]
     */
    public static function getModels() {
        return TermsBooksList::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'name');
    }
    /**
     * @param int $id
     * @return array
     */
    public static function getPrice($id) {
        $model = self::findModel($id);
        if ($model === null) {
            return [false, 0, ['id' => 'رکوردی یافت نشد!']];
        }
        return [true, $model->price, []];
    }
}