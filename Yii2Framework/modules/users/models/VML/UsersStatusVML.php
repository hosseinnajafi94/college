<?php
namespace app\modules\users\models\VML;
use Yii;
use yii\base\Model;
class UsersStatusVML extends Model {
    public $id;
    public $title;
    private $_model;
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
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}