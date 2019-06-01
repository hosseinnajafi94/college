<?php
namespace app\modules\users\models\VML;
use Yii;
use yii\base\Model;
class UsersVML extends Model {
    public $id;
    public $group_id;
    public $username;
    public $fname;
    public $lname;
    public $email;
    public $mobile;
    public $phone;
    public $address;
    public $groups = [];
    public $module = null;
    public $model = null;
    public function rules() {
        return [
                [['group_id', 'username', 'fname', 'lname'], 'required'],
                [['group_id'], 'integer'],
                [['username', 'fname', 'lname', 'email', 'mobile', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'group_id' => Yii::t('users', 'Group ID'),
            'username' => Yii::t('users', 'Username'),
            'fname' => Yii::t('users', 'Fname'),
            'lname' => Yii::t('users', 'Lname'),
            'email' => Yii::t('users', 'Email'),
            'mobile' => Yii::t('users', 'Mobile'),
            'phone' => Yii::t('users', 'Phone'),
            'address' => Yii::t('users', 'Address'),
        ];
    }
}