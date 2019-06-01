<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsPaymentsSearchVML extends Model {
    public $student_id;
    public $price;
    public $students = [];
    public function rules() {
        return [
                [['student_id', 'price'], 'integer'],
        ];
    }
    public function attributeLabels() {
        return [
            'student_id' => Yii::t('terms', 'Student ID'),
            'price' => Yii::t('terms', 'Price'),
        ];
    }
}