<?php
namespace app\modules\terms\models\SRL;
use Yii;
use app\modules\SRL;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\config\components\functions;
use app\modules\terms\models\DAL\Terms;
use app\modules\terms\models\VML\TermsVML;
use app\modules\users\models\SRL\UsersSRL;
class TermsSRL implements SRL {
    /**
     * @return ActiveDataProvider
     */
    public static function searchModel() {
        $query        = Terms::find();
        $query->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return $dataProvider;
    }
    /**
     * @return TermsVML
     */
    public static function newViewModel() {
        $data = new TermsVML();
        return $data;
    }
    /**
     * @param TermsVML $data
     * @return void
     */
    public static function loadItems($data) {
        $data->books    = TermsBooksListSRL::getItems();
        $data->teachers = UsersSRL::getItems([1, 3]);
        $data->classes  = TermsClassesListSRL::getItems();
    }
    /**
     * @param TermsVML $data
     * @return bool
     */
    public static function insert($data) {
        $data->start_date = functions::togdate($data->start_date);
        $data->end_date   = functions::togdate($data->end_date);
        if (!$data->validate()) {
            return false;
        }
        $module                = Yii::$app->getModule('terms');
        $model                 = new Terms();
        $model->book_id        = $data->book_id;
        $model->teacher_id     = $data->teacher_id;
        $model->class_id       = $data->class_id;
        $model->status_id      = $module->params['terms.Status.Active'];
        $model->name           = $data->name;
        $model->teacher_price  = $data->teacher_price;
        $model->term_price     = $data->term_price;
        $model->book_price     = $data->book_price;
        $model->total_price    = $model->term_price + $model->book_price;
        $model->start_date     = $data->start_date;
        $model->end_date       = $data->end_date;
        $model->start_time     = $data->start_time;
        $model->end_time       = $data->end_time;
        $model->meetings_count = $data->meetings_count;
        $model->sa             = $data->sa;
        $model->su             = $data->su;
        $model->mo             = $data->mo;
        $model->tu             = $data->tu;
        $model->we             = $data->we;
        $model->th             = $data->th;
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @return Terms
     */
    public static function findModel($id) {
        return Terms::findOne($id);
    }
    /**
     * @param int $id
     * @return TermsVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model === null) {
            return null;
        }
        $data                 = new TermsVML();
        $data->id             = $model->id;
        $data->book_id        = $model->book_id;
        $data->teacher_id     = $model->teacher_id;
        $data->class_id       = $model->class_id;
        $data->name           = $model->name;
        $data->teacher_price  = $model->teacher_price;
        $data->term_price     = $model->term_price;
        $data->book_price     = $model->book_price;
        $data->start_date     = $model->start_date;
        $data->end_date       = $model->end_date;
        $data->start_time     = $model->start_time;
        $data->end_time       = $model->end_time;
        $data->meetings_count = $model->meetings_count;
        $data->sa             = $model->sa;
        $data->su             = $model->su;
        $data->mo             = $model->mo;
        $data->tu             = $model->tu;
        $data->we             = $model->we;
        $data->th             = $model->th;
        $data->model          = $model;
        return $data;
    }
    /**
     * @param TermsVML $data
     * @return bool
     */
    public static function update($data) {
        $data->start_date = functions::togdate($data->start_date);
        $data->end_date   = functions::togdate($data->end_date);
        if (!$data->validate()) {
            return false;
        }
        $model                 = $data->model;
        $model->book_id        = $data->book_id;
        $model->teacher_id     = $data->teacher_id;
        $model->class_id       = $data->class_id;
        $model->name           = $data->name;
        $model->teacher_price  = $data->teacher_price;
        $model->term_price     = $data->term_price;
        $model->book_price     = $data->book_price;
        $model->total_price    = $model->term_price + $model->book_price;
        $model->start_date     = $data->start_date;
        $model->end_date       = $data->end_date;
        $model->start_time     = $data->start_time;
        $model->end_time       = $data->end_time;
        $model->meetings_count = $data->meetings_count;
        $model->sa             = $data->sa;
        $model->su             = $data->su;
        $model->mo             = $data->mo;
        $model->tu             = $data->tu;
        $model->we             = $data->we;
        $model->th             = $data->th;
        return $model->save();
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
     * @return Terms[]
     */
    public static function getModels() {
        return Terms::find()->orderBy(['id' => SORT_ASC])->all();
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
            return [false, 0, 0, ['id' => 'رکوردی یافت نشد!']];
        }
        return [true, $model->term_price, $model->book_price, []];
    }
}