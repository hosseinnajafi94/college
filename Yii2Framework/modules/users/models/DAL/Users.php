<?php
namespace app\modules\users\models\DAL;
use Yii;
/**
 * This is the model class for table "users".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $status_id
 * @property int $group_id
 * @property string $username
 * @property string $password_hash
 * @property string $fname
 * @property string $lname
 * @property string $avatar
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $address
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property UsersStatus $status
 * @property UsersGroups $group
 * @property Users $createdBy
 * @property Users[] $users
 * @property Users $updatedBy
 * @property Users[] $users0
 */
class Users extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'users';
    }
    public function rules() {
        return [
                [['status_id', 'group_id', 'username', 'password_hash', 'fname', 'lname', 'avatar', 'auth_key', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
                [['status_id', 'group_id', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['username', 'password_hash', 'fname', 'lname', 'avatar', 'email', 'mobile', 'phone', 'address', 'password_reset_token'], 'string', 'max' => 255],
                [['auth_key'], 'string', 'max' => 32],
                [['auth_key'], 'unique'],
                [['username'], 'unique'],
                [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
                [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
                [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('users', 'ID'),
            'status_id' => Yii::t('users', 'Status ID'),
            'group_id' => Yii::t('users', 'Group ID'),
            'username' => Yii::t('users', 'Username'),
            'password_hash' => Yii::t('users', 'Password Hash'),
            'fname' => Yii::t('users', 'Fname'),
            'lname' => Yii::t('users', 'Lname'),
            'avatar' => Yii::t('users', 'Avatar'),
            'email' => Yii::t('users', 'Email'),
            'mobile' => Yii::t('users', 'Mobile'),
            'phone' => Yii::t('users', 'Phone'),
            'address' => Yii::t('users', 'Address'),
            'password_reset_token' => Yii::t('users', 'Password Reset Token'),
            'auth_key' => Yii::t('users', 'Auth Key'),
            'created_at' => Yii::t('users', 'Created At'),
            'created_by' => Yii::t('users', 'Created By'),
            'updated_at' => Yii::t('users', 'Updated At'),
            'updated_by' => Yii::t('users', 'Updated By'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(UsersStatus::className(), ['id' => 'status_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup() {
        return $this->hasOne(UsersGroups::className(), ['id' => 'group_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(Users::className(), ['created_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0() {
        return $this->hasMany(Users::className(), ['updated_by' => 'id']);
    }
}