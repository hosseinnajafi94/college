<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsBooksListVML extends Model {
    public $id;
    public $name;
    public $price;
    private $_model;
    public function rules() {
        return [
                [['name', 'price'], 'required'],
                [['price'], 'integer'],
                [['name'], 'string', 'max' => 255],
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
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}