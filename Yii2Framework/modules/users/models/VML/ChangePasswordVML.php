<?php
namespace app\modules\users\models\VML;
use Yii;
use yii\base\Model;
class ChangePasswordVML extends Model {
    public $old_password;
    public $new_password;
    public $new_password_repeat;
    public $model = null;
    public function rules() {
        return [
                [['old_password', 'new_password', 'new_password_repeat'], 'required'],
                [['old_password', 'new_password', 'new_password_repeat'], 'string', 'max' => 255],
                [['new_password_repeat'], 'compare', 'compareAttribute' => 'new_password'],
        ];
    }
    public function attributeLabels() {
        return [
            'old_password'        => Yii::t('users', 'Old Password'),
            'new_password'        => Yii::t('users', 'New Password'),
            'new_password_repeat' => Yii::t('users', 'New Password Repeat'),
        ];
    }
}