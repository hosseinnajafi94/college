<?php
namespace app\modules\terms\models\DAL;
use Yii;
use app\modules\users\models\DAL\Users;
/**
 * This is the model class for table "terms_meetings".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $term_id
 * @property int $teacher_id
 * @property string $date
 *
 * @property Terms $term
 * @property Users $teacher
 * @property TermsMeetingsAbsenteeism[] $termsMeetingsAbsenteeisms
 */
class TermsMeetings extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms_meetings';
    }
    public function rules() {
        return [
                [['term_id', 'teacher_id', 'date'], 'required'],
                [['term_id', 'teacher_id'], 'integer'],
                [['date'], 'safe'],
                [['term_id'], 'exist', 'skipOnError' => true, 'targetClass' => Terms::className(), 'targetAttribute' => ['term_id' => 'id']],
                [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'term_id' => Yii::t('terms', 'Term ID'),
            'teacher_id' => Yii::t('terms', 'Teacher ID'),
            'date' => Yii::t('terms', 'Date'),
        ];
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
    public function getTeacher() {
        return $this->hasOne(Users::className(), ['id' => 'teacher_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermsMeetingsAbsenteeisms() {
        return $this->hasMany(TermsMeetingsAbsenteeism::className(), ['meeting_id' => 'id']);
    }
}