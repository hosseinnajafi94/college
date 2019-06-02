<?php
namespace app\modules\terms\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\terms\models\SRL\TermsStudentsSRL;
class TermsStudentsController extends Controller {
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
        $model = TermsStudentsSRL::searchModel();
        return $this->renderView($model);
    }
    public function actionView($id) {
        $model = TermsStudentsSRL::findModel($id);
        if ($model == null) {
            return functions::httpNotFound();
        }
        return $this->renderView($model);
    }
    public function actionCreate() {
        $model = TermsStudentsSRL::newViewModel();
        if (TermsStudentsSRL::insert($model, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        TermsStudentsSRL::loadItems($model);
        return $this->renderView($model);
    }
    public function actionUpdate($id) {
        $model = TermsStudentsSRL::findViewModel($id);
        if ($model == null) {
            return functions::httpNotFound();
        }
        if (TermsStudentsSRL::update($model, Yii::$app->request->post())) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        TermsStudentsSRL::loadItems($model);
        return $this->renderView($model);
    }
    public function actionDelete($id) {
        $deleted = TermsStudentsSRL::delete($id);
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