<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsMeetingsAbsenteeismVML extends Model {
    public $id;
    public $meeting_id;
    public $student_id;
    public $presence;
    public $meetings = [];
    public $students = [];
    private $_model;
    public function rules() {
        return [
                [['meeting_id', 'student_id', 'presence'], 'required'],
                [['meeting_id', 'student_id', 'presence'], 'integer'],
        ];
    }
    public function attributeLabels() {
        return [
            'meeting_id' => Yii::t('terms', 'Meeting ID'),
            'student_id' => Yii::t('terms', 'Student ID'),
            'presence' => Yii::t('terms', 'Presence'),
        ];
    }
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}