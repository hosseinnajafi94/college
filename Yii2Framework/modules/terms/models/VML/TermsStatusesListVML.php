<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsStatusesListVML extends Model {
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
            'title' => Yii::t('terms', 'Title'),
        ];
    }
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}