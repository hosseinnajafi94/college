<?php
namespace app\modules\terms\models\VML;
use Yii;
use yii\base\Model;
class TermsClassesListSearchVML extends Model {
    public $title;
    public function rules() {
        return [
                [['title'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'title' => Yii::t('terms', 'Title'),
        ];
    }
}