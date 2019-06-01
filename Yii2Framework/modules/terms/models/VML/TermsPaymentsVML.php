<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsPaymentsVML extends Model {
    public $id;
    public $student_id;
    public $price;
    public $students = [];
    private $_model;
    public function rules() {
        return [
                [['student_id', 'price'], 'required'],
                [['student_id', 'price'], 'integer'],
        ];
    }
    public function attributeLabels() {
        return [
            'student_id' => Yii::t('terms', 'Student ID'),
            'price' => Yii::t('terms', 'Price'),
        ];
    }
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}