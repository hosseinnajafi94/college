<?php
namespace app\modules\users\models\SRL;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\users\models\DAL\Users;
use app\modules\users\models\VML\UsersVML;
use app\config\components\functions;
class UsersSRL {
    /**
     * @return ActiveDataProvider
     */
    public static function searchModel() {
        $module       = Yii::$app->getModule('users');
        $query        = Users::find()->where(['status_id' => $module->params['status.Active']])->orderBy(['id' => SORT_DESC]);
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
        $data = new UsersVML();
        $data->module = Yii::$app->getModule('users');
        return $data;
    }
    /**
     * @param UsersVML $data
     * @return void
     */
    public static function loadItems($data) {
        $data->groups = UsersGroupsSRL::getItems();
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
        $model->group_id      = $data->group_id;
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
            self::assignRoleToUser($data);
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
        return Users::findOne(['id' => $id, 'status_id' => $module->params['status.Active']]);
    }
    /**
     * @param int $id
     * @return UsersVML
     */
    public static function findViewModel($id) {
        $module = Yii::$app->getModule('users');
        $model = self::findModel($id, $module);
        if ($model === null) {
            return null;
        }
        $data           = new UsersVML();
        $data->id       = $model->id;
        $data->group_id = $model->group_id;
        $data->username = $model->username;
        $data->fname    = $model->fname;
        $data->lname    = $model->lname;
        $data->email    = $model->email;
        $data->mobile   = $model->mobile;
        $data->phone    = $model->phone;
        $data->address  = $model->address;
        $data->model    = $model;
        $data->module   = $module;
        return $data;
    }
    /**
     * @param UsersVML $data
     * @param int $userId
     * @param array $postParams
     * @return bool
     */
    public static function update($data, $userId, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $model             = $data->model;
        $model->group_id   = $data->group_id;
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
            self::assignRoleToUser($data);
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
        $model->updated_at = functions::getdatetime();
        $model->updated_by = $userId;
        return $model->save();
    }
    /**
     * @return Users[]
     */
    public static function getModels($groupId = null) {
        $query = Users::find()->orderBy(['fname' => SORT_ASC, 'lname' => SORT_ASC]);
        if ($groupId != null) {
            $query->where(['group_id' => $groupId]);
        }
        return $query->all();
    }
    /**
     * @return array
     */
    public static function getItems($groupId = null) {
        $models = self::getModels($groupId);
        return ArrayHelper::map($models, 'id', function ($model) {
            return '# ' . $model->id . ' / ' . $model->fname . ' ' . $model->lname;
        });
    }
    /**
     * @param UsersVML $user User View Model
     * @return void
     */
    public static function assignRoleToUser($user) {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($user->id);
        $role = null;
        switch ($user->group_id) {
            case $user->module->params['group.Admin']:
                $role = $auth->getRole('admin');
                break;
            case $user->module->params['group.Clerk']:
                $role = $auth->getRole('clerk');
                break;
            case $user->module->params['group.Teacher']:
                $role = $auth->getRole('teacher');
                break;
            case $user->module->params['group.Student']:
                $role = $auth->getRole('student');
                break;
        }
        if ($role) {
            $auth->assign($role, $user->id);
        }
    }
}