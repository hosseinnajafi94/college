<?php
namespace app\modules\site\controllers;
use app\config\widgets\Controller;
class DefaultController extends Controller {
    public function actions() {
        return [
            'error' => [
                'class'  => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex() {
        
        return $this->renderView();
    }
}