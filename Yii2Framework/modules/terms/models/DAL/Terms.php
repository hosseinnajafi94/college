<?php
namespace app\modules\terms\models\DAL;
use Yii;
use app\modules\users\models\DAL\Users;
/**
 * This is the model class for table "terms".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $book_id
 * @property int $teacher_id
 * @property int $class_id
 * @property int $status_id
 * @property string $name
 * @property int $teacher_price
 * @property int $term_price
 * @property int $book_price
 * @property int $total_price
 * @property string $start_date
 * @property string $end_date
 * @property string $start_time
 * @property string $end_time
 * @property int $meetings_count
 * @property int $sa
 * @property int $su
 * @property int $mo
 * @property int $tu
 * @property int $we
 * @property int $th
 *
 * @property TermsBooksList $book
 * @property Users $teacher
 * @property TermsClassesList $class
 * @property TermsStatusesList $status
 * @property TermsMeetings[] $termsMeetings
 * @property TermsStudents[] $termsStudents
 */
class Terms extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms';
    }
    public function rules() {
        return [
                [['book_id', 'teacher_id', 'class_id', 'status_id', 'name', 'teacher_price', 'term_price', 'book_price', 'total_price', 'start_date', 'end_date', 'start_time', 'end_time', 'meetings_count', 'sa', 'su', 'mo', 'tu', 'we', 'th'], 'required'],
                [['book_id', 'teacher_id', 'class_id', 'status_id', 'teacher_price', 'term_price', 'book_price', 'total_price', 'meetings_count', 'sa', 'su', 'mo', 'tu', 'we', 'th'], 'integer'],
                [['start_date', 'end_date', 'start_time', 'end_time'], 'safe'],
                [['name'], 'string', 'max' => 255],
                [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => TermsBooksList::className(), 'targetAttribute' => ['book_id' => 'id']],
                [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['teacher_id' => 'id']],
                [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => TermsClassesList::className(), 'targetAttribute' => ['class_id' => 'id']],
                [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TermsStatusesList::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'book_id' => Yii::t('terms', 'Book ID'),
            'teacher_id' => Yii::t('terms', 'Teacher ID'),
            'class_id' => Yii::t('terms', 'Class ID'),
            'status_id' => Yii::t('terms', 'Status ID'),
            'name' => Yii::t('terms', 'Name'),
            'teacher_price' => Yii::t('terms', 'Teacher Price'),
            'term_price' => Yii::t('terms', 'Term Price'),
            'book_price' => Yii::t('terms', 'Book Price'),
            'total_price' => Yii::t('terms', 'Total Price'),
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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook() {
        return $this->hasOne(TermsBooksList::className(), ['id' => 'book_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher() {
        return $this->hasOne(Users::className(), ['id' => 'teacher_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass() {
        return $this->hasOne(TermsClassesList::className(), ['id' => 'class_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(TermsStatusesList::className(), ['id' => 'status_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermsMeetings() {
        return $this->hasMany(TermsMeetings::className(), ['term_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermsStudents() {
        return $this->hasMany(TermsStudents::className(), ['term_id' => 'id']);
    }
}