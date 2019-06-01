<?php
namespace app\modules\terms\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\terms\models\SRL\TermsStatusesListSRL;
class TermsStatusesListController extends Controller {
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
        list($searchModel, $dataProvider) = TermsStatusesListSRL::searchModel();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id) {
        $model = TermsStatusesListSRL::findModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }
    public function actionCreate() {
        $model = TermsStatusesListSRL::newViewModel();
        if ($model->load(Yii::$app->request->post()) && TermsStatusesListSRL::insert($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TermsStatusesListSRL::loadItems($model);
        return $this->render('create', [
                    'model' => $model,
        ]);
    }
    public function actionUpdate($id) {
        $model = TermsStatusesListSRL::findViewModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        if ($model->load(Yii::$app->request->post()) && TermsStatusesListSRL::update($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TermsStatusesListSRL::loadItems($model);
        return $this->render('update', [
                    'model' => $model,
        ]);
    }
    public function actionDelete($id) {
        $deleted = TermsStatusesListSRL::delete($id);
        if ($deleted) {
            functions::setSuccessFlash();
        }
        else {
            functions::setFailFlash();
        }
        return $this->redirect(['index']);
    }
}