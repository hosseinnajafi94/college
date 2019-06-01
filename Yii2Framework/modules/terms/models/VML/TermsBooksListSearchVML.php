<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsBooksListSearchVML extends Model {
    public $name;
    public $price;
    public function rules() {
        return [
                [['name'], 'string', 'max' => 255],
                [['price'], 'integer'],
        ];
    }
    public function attributeLabels() {
        return [
            'name' => Yii::t('terms', 'Name'),
            'price' => Yii::t('terms', 'Price'),
        ];
    }
    public function attributeHints() {
        return [
            'price' => Yii::t('app', 'Toman')
        ];
    }
}