<?php
namespace app\modules\terms\models\DAL;
use Yii;
/**
 * This is the model class for table "terms_meetings_absenteeism".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $meeting_id
 * @property int $student_id
 * @property int $presence
 *
 * @property TermsMeetings $meeting
 * @property TermsStudents $student
 */
class TermsMeetingsAbsenteeism extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms_meetings_absenteeism';
    }
    public function rules() {
        return [
                [['meeting_id', 'student_id', 'presence'], 'required'],
                [['meeting_id', 'student_id', 'presence'], 'integer'],
                [['meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => TermsMeetings::className(), 'targetAttribute' => ['meeting_id' => 'id']],
                [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => TermsStudents::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'meeting_id' => Yii::t('terms', 'Meeting ID'),
            'student_id' => Yii::t('terms', 'Student ID'),
            'presence' => Yii::t('terms', 'Presence'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeeting() {
        return $this->hasOne(TermsMeetings::className(), ['id' => 'meeting_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent() {
        return $this->hasOne(TermsStudents::className(), ['id' => 'student_id']);
    }
}