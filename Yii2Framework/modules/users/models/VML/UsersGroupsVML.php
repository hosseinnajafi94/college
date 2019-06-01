<?php
namespace app\modules\users\models\VML;
use Yii;
use yii\base\Model;
class UsersGroupsVML extends Model {
    public $id;
    public $title;
    public $model;
    public function rules() {
        return [
                [['title'], 'required'],
                [['title'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'title' => Yii::t('users', 'Title'),
        ];
    }
}