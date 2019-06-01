<?php
namespace app\modules\terms\controllers;
use Yii;
use app\config\widgets\Controller;
use yii\filters\AccessControl;
use app\config\components\functions;
use app\modules\terms\models\SRL\TermsPaymentsSRL;
class TermsPaymentsController extends Controller {
//    public function behaviors() {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'view'],
//                        'roles' => ['admin'],
//                        'verbs' => ['GET']
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['delete'],
//                        'roles' => ['admin'],
//                        'verbs' => ['POST']
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['create', 'update'],
//                        'roles' => ['admin'],
//                        'verbs' => ['GET', 'POST']
//                    ],
//                ],
//            ],
//        ];
//    }
    public function actionIndex() {
        list($searchModel, $dataProvider) = TermsPaymentsSRL::searchModel();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id) {
        $model = TermsPaymentsSRL::findModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }
    public function actionCreate() {
        $model = TermsPaymentsSRL::newViewModel();
        if ($model->load(Yii::$app->request->post()) && TermsPaymentsSRL::insert($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TermsPaymentsSRL::loadItems($model);
        return $this->render('create', [
                    'model' => $model,
        ]);
    }
    public function actionUpdate($id) {
        $model = TermsPaymentsSRL::findViewModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        if ($model->load(Yii::$app->request->post()) && TermsPaymentsSRL::update($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TermsPaymentsSRL::loadItems($model);
        return $this->render('update', [
                    'model' => $model,
        ]);
    }
    public function actionDelete($id) {
        $deleted = TermsPaymentsSRL::delete($id);
        if ($deleted) {
            functions::setSuccessFlash();
        }
        else {
            functions::setFailFlash();
        }
        return $this->redirect(['index']);
    }
}