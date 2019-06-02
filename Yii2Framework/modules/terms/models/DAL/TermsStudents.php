<?php
namespace app\modules\terms\models\DAL;
use Yii;
use app\modules\users\models\DAL\Users;
/**
 * This is the model class for table "terms_students".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $term_id
 * @property int $student_id
 * @property string $register_date
 * @property int $class_price
 * @property int $book_price
 * @property int $total_price
 *
 * @property TermsMeetingsAbsenteeism[] $termsMeetingsAbsenteeisms
 * @property Terms $term
 * @property Users $student
 */
class TermsStudents extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms_students';
    }
    public function rules() {
        return [
                [['term_id', 'student_id', 'register_date', 'class_price', 'book_price', 'total_price'], 'required'],
                [['term_id', 'student_id', 'class_price', 'book_price', 'total_price'], 'integer'],
                [['register_date'], 'safe'],
                [['term_id', 'student_id'], 'unique', 'targetAttribute' => ['term_id', 'student_id']],
                [['term_id'], 'exist', 'skipOnError' => true, 'targetClass' => Terms::className(), 'targetAttribute' => ['term_id' => 'id']],
                [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'term_id' => Yii::t('terms', 'Term ID'),
            'student_id' => Yii::t('terms', 'Student ID'),
            'register_date' => Yii::t('terms', 'Register Date'),
            'class_price' => Yii::t('terms', 'Class Price'),
            'book_price' => Yii::t('terms', 'Book Price'),
            'total_price' => Yii::t('terms', 'Total Price'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermsMeetingsAbsenteeisms() {
        return $this->hasMany(TermsMeetingsAbsenteeism::className(), ['student_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm() {
        return $this->hasOne(Terms::className(), ['id' => 'term_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent() {
        return $this->hasOne(Users::className(), ['id' => 'student_id']);
    }
}