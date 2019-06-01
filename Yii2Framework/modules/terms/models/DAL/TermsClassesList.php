<?php
namespace app\modules\terms\models\DAL;
use Yii;
/**
 * This is the model class for table "terms_classes_list".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property string $title
 *
 * @property Terms[] $terms
 */
class TermsClassesList extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms_classes_list';
    }
    public function rules() {
        return [
                [['title'], 'required'],
                [['title'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'title' => Yii::t('terms', 'Title'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms() {
        return $this->hasMany(Terms::className(), ['class_id' => 'id']);
    }
}