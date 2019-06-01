<?php
namespace app\modules\terms\models\DAL;
use Yii;
use app\modules\users\models\DAL\Users;
/**
 * This is the model class for table "terms_payments".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $student_id
 * @property int $price
 *
 * @property Users $student
 */
class TermsPayments extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms_payments';
    }
    public function rules() {
        return [
                [['student_id', 'price'], 'required'],
                [['student_id', 'price'], 'integer'],
                [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'student_id' => Yii::t('terms', 'Student ID'),
            'price' => Yii::t('terms', 'Price'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent() {
        return $this->hasOne(Users::className(), ['id' => 'student_id']);
    }
}