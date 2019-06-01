<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsVML extends Model {
    public $id;
    public $book_id;
    public $teacher_id;
    public $class_id;
    public $name;
    public $teacher_price;
    public $term_price;
    public $book_price;
    public $start_date;
    public $end_date;
    public $start_time;
    public $end_time;
    public $meetings_count;
    public $sa;
    public $su;
    public $mo;
    public $tu;
    public $we;
    public $th;
    public $books = [];
    public $teachers = [];
    public $classes = [];
    public $model;
    public function rules() {
        return [
                [['book_id', 'teacher_id', 'class_id', 'name', 'teacher_price', 'term_price', 'book_price', 'start_date', 'end_date', 'start_time', 'end_time', 'meetings_count', 'sa', 'su', 'mo', 'tu', 'we', 'th'], 'required'],
                [['book_id', 'teacher_id', 'class_id', 'teacher_price', 'term_price', 'book_price', 'meetings_count', 'sa', 'su', 'mo', 'tu', 'we', 'th'], 'integer'],
                [['start_date', 'end_date', 'start_time', 'end_time'], 'safe'],
                [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'book_id' => Yii::t('terms', 'Book ID'),
            'teacher_id' => Yii::t('terms', 'Teacher ID'),
            'class_id' => Yii::t('terms', 'Class ID'),
            'name' => Yii::t('terms', 'Name'),
            'teacher_price' => Yii::t('terms', 'Teacher Price'),
            'term_price' => Yii::t('terms', 'Term Price'),
            'book_price' => Yii::t('terms', 'Book Price'),
            'start_date' => Yii::t('terms', 'Start Date'),
            'end_date' => Yii::t('terms', 'End Date'),
            'start_time' => Yii::t('terms', 'Start Time'),
            'end_time' => Yii::t('terms', 'End Time'),
            'meetings_count' => Yii::t('terms', 'Meetings Count'),
            'sa' => Yii::t('terms', 'Sa'),
            'su' => Yii::t('terms', 'Su'),
            'mo' => Yii::t('terms', 'Mo'),
            'tu' => Yii::t('terms', 'Tu'),
            'we' => Yii::t('terms', 'We'),
            'th' => Yii::t('terms', 'Th'),
        ];
    }
    public function attributeHints() {
        return [
            'teacher_price' => Yii::t('app', 'Toman'),
            'term_price' => Yii::t('app', 'Toman'),
            'book_price' => Yii::t('app', 'Toman'),
        ];
    }
}