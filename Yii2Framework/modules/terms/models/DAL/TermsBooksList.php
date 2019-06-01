<?php
namespace app\modules\terms\models\DAL;
use Yii;
/**
 * This is the model class for table "terms_books_list".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property string $name
 * @property int $price
 *
 * @property Terms[] $terms
 */
class TermsBooksList extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'terms_books_list';
    }
    public function rules() {
        return [
                [['name', 'price'], 'required'],
                [['price'], 'integer'],
                [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('terms', 'ID'),
            'name' => Yii::t('terms', 'Name'),
            'price' => Yii::t('terms', 'Price'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms() {
        return $this->hasMany(Terms::className(), ['book_id' => 'id']);
    }
}