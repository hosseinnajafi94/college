<?php
namespace app\modules\users\models\SRL;
use Yii;
use app\modules\users\models\VML\LoginVML;
use app\modules\users\models\DAL\User;
class AuthSRL {
    public static function newLoginViewModel() {
        $data = new LoginVML();
        return $data;
    }
    public static function login($data, $postParams = []) {
        if (!$data->load($postParams) || !$data->validate()) {
            return false;
        }
        $user = User::findOne(['username' => $data->username]);
        if (!$user) {
            $data->addError('username', Yii::t('users', 'Incorrect Username.'));
            return false;
        }
        $module = Yii::$app->getModule('users');
        if ($user->status_id != $module->params['status.Active']) {
            $data->addError('username', Yii::t('users', 'This User Is Not Active.'));
            return false;
        }
        if (!Yii::$app->security->validatePassword($data->password, $user->password_hash)) {
            $data->addError('password', Yii::t('users', 'Incorrect Password.'));
            return false;
        }
        return Yii::$app->user->login($user, $data->rememberMe ? $module->params['rememberMeExpire'] : 0);
    }
}