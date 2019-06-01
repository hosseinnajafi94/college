<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\terms\models\DAL\TermsPayments;
use app\modules\terms\models\VML\TermsPaymentsVML;
use app\modules\terms\models\VML\TermsPaymentsSearchVML;
use app\modules\users\models\SRL\UsersSRL;
class TermsPaymentsSRL implements SRL {
    /**
     * @return array [TermsPaymentsSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $searchModel = new TermsPaymentsSearchVML();
        $query = TermsPayments::find();
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
        $query->andFilterWhere(['student_id' => $searchModel->student_id]);
        $query->andFilterWhere(['price' => $searchModel->price]);
        return [$searchModel, $dataProvider];
    }
    /**
     * @return TermsPaymentsVML
     */
    public static function newViewModel() {
        $data = new TermsPaymentsVML();
        return $data;
    }
    /**
     * @param TermsPaymentsVML $data
     * @return void
     */
    public static function loadItems($data) {
        $data->students = UsersSRL::getItems();
    }
    /**
     * @param TermsPaymentsVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = new TermsPayments();
        $model->student_id = $data->student_id;
        $model->price = $data->price;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return TermsPayments     */
    public static function findModel($id) {
        return TermsPayments::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsPaymentsVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data = new TermsPaymentsVML();
        $data->id = $model->id;
        $data->student_id = $model->student_id;
        $data->price = $model->price;
        $data->setModel($model);
        return $data;
    }
    /**
     * @param TermsPaymentsVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
        $model->student_id = $data->student_id;
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
     * @return TermsPayments[]
     */
    public static function getModels() {
        return TermsPayments::find()->orderBy(['id' => SORT_ASC])->all();
    }
    /**
     * @return array
     */
    public static function getItems() {
        $models = self::getModels();
        return ArrayHelper::map($models, 'id', 'id');
    }
}