<?php
namespace app\modules\terms;
use Yii;
class Module extends \yii\base\Module {
    public $controllerNamespace = 'app\modules\terms\controllers';
    public function init() {
        parent::init();
        Yii::configure($this, require __DIR__ . '/config.php');
    }
}