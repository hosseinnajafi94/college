<?php
namespace app\modules\users\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\users\models\SRL\UsersStatusSRL;
class UsersStatusController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['admin'],
                        'verbs' => ['GET']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['admin'],
                        'verbs' => ['POST']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update'],
                        'roles' => ['admin'],
                        'verbs' => ['GET', 'POST']
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
        $model = UsersStatusSRL::searchModel();
        return $this->renderView($model);
    }
    public function actionView($id) {
        $model = UsersStatusSRL::findModel($id);
        if ($model == null) {
            return functions::httpNotFound();
        }
        return $this->renderView($model);
    }
    public function actionCreate() {
        $model = UsersStatusSRL::newViewModel();
        if (UsersStatusSRL::insert($model, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        return $this->renderView($model);
    }
    public function actionUpdate($id) {
        $model = UsersStatusSRL::findViewModel($id);
        if ($model == null) {
            return functions::httpNotFound();
        }
        if (UsersStatusSRL::update($model, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        return $this->renderView($model);
    }
    public function actionDelete($id) {
        $deleted = UsersStatusSRL::delete($id);
        if ($deleted === null) {
            return functions::httpNotFound();
        }
        else if ($deleted === true) {
            functions::setSuccessFlash();
        }
        else if ($deleted === false) {
            functions::setFailFlash();
        }
        return $this->redirectToIndex();
    }
}