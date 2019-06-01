<?php
namespace app\modules\users\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\users\models\SRL\UsersSRL;
use app\modules\users\models\SRL\ProfileSRL;
class ProfileController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                        'verbs' => ['GET']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['password', 'update'],
                        'roles' => ['@'],
                        'verbs' => ['GET', 'POST']
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
        $model = UsersSRL::findModel(Yii::$app->user->id);
        if ($model === null) {
            return functions::httpNotFound();
        }
        return $this->renderView($model);
    }
    public function actionPassword() {
        $model = ProfileSRL::findChangePasswordViewModel(Yii::$app->user->id);
        if ($model === null) {
            return functions::httpNotFound();
        }
        if (ProfileSRL::changePassword($model, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToIndex([], 'password');
        }
        return $this->renderView($model);
    }
    public function actionUpdate() {
        $model = ProfileSRL::findProfileViewModel(Yii::$app->user->id);
        if ($model === null) {
            return functions::httpNotFound();
        }
        if (ProfileSRL::updateProfile($model, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToIndex();
        }
        return $this->renderView($model);
    }
}