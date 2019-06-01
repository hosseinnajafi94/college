<?php
namespace app\modules\users\models\SRL;
use Yii;
use app\modules\users\models\VML\ChangePasswordVML;
use app\modules\users\models\VML\ProfileVML;
use app\config\components\functions;
class ProfileSRL {
    /**
     * @param int $userId
     * @return ChangePasswordVML
     */
    public static function findChangePasswordViewModel($userId) {
        $model = UsersSRL::findModel($userId);
        if ($model === null) {
            return null;
        }
        $data        = new ChangePasswordVML();
        $data->model = $model;
        return $data;
    }
    /**
     * @param ChangePasswordVML $data
     * @param array $postParams
     * @return bool
     */
    public static function changePassword($data, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $model = $data->model;
        if (!Yii::$app->security->validatePassword($data->old_password, $model->password_hash)) {
            $data->addError('old_password', Yii::t('users', 'The old password is wrong!'));
            return false;
        }
        $model->password_hash = Yii::$app->security->generatePasswordHash($data->new_password);
        $model->updated_at    = functions::getdatetime();
        $model->updated_by    = $model->id;
        return $model->save();
    }
    /**
     * @param int $userId
     * @return ProfileVML
     */
    public static function findProfileViewModel($userId) {
        $model = UsersSRL::findModel($userId);
        if ($model === null) {
            return null;
        }
        $data           = new ProfileVML();
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
     * @param ProfileVML $data
     * @param array $postParams
     * @return bool
     */
    public static function updateProfile($data, $postParams = []) {
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
        $model->updated_by = $model->id;
        return $model->save();
    }
}