<?php
namespace app\modules\users\models\SRL;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\users\models\DAL\Users;
use app\modules\users\models\VML\ClerkVML;
use app\config\components\functions;
class ClerkSRL {
    /**
     * @return ActiveDataProvider
     */
    public static function searchModel() {
        $module       = Yii::$app->getModule('users');
        $query        = Users::find();
        $query->where(['status_id' => $module->params['status.Active']]);
        $query->andWhere(['group_id' => $module->params['group.Clerk']]);
        $query->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return $dataProvider;
    }
    /**
     * @return UsersVML
     */
    public static function newViewModel() {
        $data = new ClerkVML();
        return $data;
    }
    /**
     * @param UsersVML $data
     * @param int $userId
     * @param array $postParams
     * @return bool
     */
    public static function insert($data, $userId, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $module               = Yii::$app->getModule('users');
        $datetime             = functions::getdatetime();
        $model                = new Users();
        $model->status_id     = $module->params['status.Active'];
        $model->group_id      = $module->params['group.Clerk'];
        $model->username      = $data->username;
        $model->password_hash = Yii::$app->security->generatePasswordHash($module->params['defaultPassword']);
        $model->fname         = $data->fname;
        $model->lname         = $data->lname;
        $model->avatar        = $module->params['defaultAvatar'];
        $model->email         = $data->email;
        $model->mobile        = $data->mobile;
        $model->phone         = $data->phone;
        $model->address       = $data->address;
        $model->auth_key      = Yii::$app->security->generateRandomString();
        $model->created_at    = $datetime;
        $model->created_by    = $userId;
        $model->updated_at    = $datetime;
        $model->updated_by    = $userId;
        if ($model->save()) {
            $data->id = $model->id;
            $auth     = Yii::$app->authManager;
            $role     = $auth->getRole('clerk');
            $auth->assign($role, $model->id);
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @param Module $module
     * @return Users
     */
    public static function findModel($id, $module = null) {
        if ($module === null) {
            $module = Yii::$app->getModule('users');
        }
        $query = Users::find();
        $query->where(['status_id' => $module->params['status.Active']]);
        $query->andWhere(['group_id' => $module->params['group.Clerk']]);
        $query->andWhere(['id' => $id]);
        return $query->one();
    }
    /**
     * @param int $id
     * @return ClerkVML
     */
    public static function findViewModel($id) {
        $model = self::findModel($id);
        if ($model === null) {
            return null;
        }
        $data           = new ClerkVML();
        $data->id       = $model->id;
        $data->username = $model->username;
        $data->fname    = $model->fname;
        $data->lname    = $model->lname;
        $data->email    = $model->email;
        $data->mobile   = $model->mobile;
        $data->phone    = $model->phone;
        $data->address  = $model->address;
        $data->model    = $model;
        return $data;
    }
    /**
     * @param ClerkVML $data
     * @param int $userId
     * @param array $postParams
     * @return bool
     */
    public static function update($data, $userId, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $model             = $data->model;
        $model->username   = $data->username;
        $model->fname      = $data->fname;
        $model->lname      = $data->lname;
        $model->email      = $data->email;
        $model->mobile     = $data->mobile;
        $model->phone      = $data->phone;
        $model->address    = $data->address;
        $model->updated_at = functions::getdatetime();
        $model->updated_by = $userId;
        if ($model->save()) {
            return true;
        }
        return false;
    }
    /**
     * @param int $id
     * @param int $userId
     * @return bool|null
     */
    public static function delete($id, $userId) {
        $module = Yii::$app->getModule('users');
        $model  = self::findModel($id, $module);
        if ($model === null) {
            return null;
        }
        $model->status_id  = $module->params['status.Delete'];
        $model->updated_at = functions::getdatetime();
        $model->updated_by = $userId;
        return $model->save();
    }
    /**
     * @param int $id
     * @param int $userId
     * @return bool|null
     */
    public static function resetPassword($id, $userId) {
        $module = Yii::$app->getModule('users');
        $model  = self::findModel($id, $module);
        if ($model === null) {
            return null;
        }
        $model->password_hash = Yii::$app->security->generatePasswordHash($module->params['defaultPassword']);
        $model->updated_at    = functions::getdatetime();
        $model->updated_by    = $userId;
        return $model->save();
    }
    /**
     * @return Users[]
     */
    public static function getModels() {
        $module = Yii::$app->getModule('users');
        $query  = Users::find();
        $query->where(['status_id' => $module->params['status.Active']]);
        $query->andWhere(['group_id' => $module->params['group.Clerk']]);
        $query->orderBy(['id' => SORT_ASC]);
        return $query->all();
    }
    /**
     * @return array
     */
    public static function getItems($groupId = null) {
        $models = self::getModels($groupId);
        return ArrayHelper::map($models, 'id', function ($model) {
            return $model->username . ' / ' . $model->fname . ' ' . $model->lname;
        });
    }
}