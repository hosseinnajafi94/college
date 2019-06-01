<?php
namespace app\modules\users\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\users\models\SRL\ClerkSRL;
class ClerkController extends Controller {
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
                        'actions' => ['delete', 'reset-password'],
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
        $model = ClerkSRL::searchModel();
        return $this->renderView($model);
    }
    public function actionView($id) {
        $model = ClerkSRL::findModel($id);
        if ($model == null) {
            return functions::httpNotFound();
        }
        return $this->renderView($model);
    }
    public function actionCreate() {
        $model = ClerkSRL::newViewModel();
        if (ClerkSRL::insert($model, Yii::$app->user->id, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        return $this->renderView($model);
    }
    public function actionUpdate($id) {
        $model = ClerkSRL::findViewModel($id);
        if ($model == null) {
            return functions::httpNotFound();
        }
        if (ClerkSRL::update($model, Yii::$app->user->id, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        return $this->renderView($model);
    }
    public function actionDelete($id) {
        $deleted = ClerkSRL::delete($id, Yii::$app->user->id);
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
    public function actionResetPassword($id) {
        $reseted = ClerkSRL::resetPassword($id, Yii::$app->user->id);
        if ($reseted === null) {
            return functions::httpNotFound();
        }
        else if ($reseted === true) {
            functions::setSuccessFlash();
        }
        else if ($reseted === false) {
            functions::setFailFlash();
        }
        return $this->redirectToView(['id' => $id], 'reset-password');
    }
}