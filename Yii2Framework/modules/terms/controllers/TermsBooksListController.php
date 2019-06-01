<?php
namespace app\modules\terms\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\terms\models\SRL\TermsBooksListSRL;
class TermsBooksListController extends Controller {
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
                        'actions' => ['delete', 'get-price'],
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
        list($searchModel, $dataProvider) = TermsBooksListSRL::searchModel();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id) {
        $model = TermsBooksListSRL::findModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }
    public function actionCreate() {
        $model = TermsBooksListSRL::newViewModel();
        if ($model->load(Yii::$app->request->post()) && TermsBooksListSRL::insert($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TermsBooksListSRL::loadItems($model);
        return $this->render('create', [
                    'model' => $model,
        ]);
    }
    public function actionUpdate($id) {
        $model = TermsBooksListSRL::findViewModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        if ($model->load(Yii::$app->request->post()) && TermsBooksListSRL::update($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TermsBooksListSRL::loadItems($model);
        return $this->render('update', [
                    'model' => $model,
        ]);
    }
    public function actionDelete($id) {
        $deleted = TermsBooksListSRL::delete($id);
        if ($deleted) {
            functions::setSuccessFlash();
        }
        else {
            functions::setFailFlash();
        }
        return $this->redirect(['index']);
    }
    public function actionGetPrice() {
        $id = Yii::$app->request->post('id');
        list($saved, $price, $messages) = TermsBooksListSRL::getPrice($id);
        return $this->asJson([
            'saved'    => $saved,
            'price'    => $price,
            'messages' => $messages,
        ]);
    }
}