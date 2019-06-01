<?php
namespace app\modules\terms\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\terms\models\SRL\TermsSRL;
class TermsController extends Controller {
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
        $model = TermsSRL::searchModel();
        return $this->renderView($model);
    }
    public function actionView($id) {
        $model = TermsSRL::findModel($id);
        if ($model === null) {
            return functions::httpNotFound();
        }
        return $this->renderView($model);
    }
    public function actionCreate() {
        $model = TermsSRL::newViewModel();
        if ($model->load(Yii::$app->request->post()) && TermsSRL::insert($model)) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        TermsSRL::loadItems($model);
        return $this->renderView($model);
    }
    public function actionUpdate($id) {
        $model = TermsSRL::findViewModel($id);
        if ($model === null) {
            return functions::httpNotFound();
        }
        if ($model->load(Yii::$app->request->post()) && TermsSRL::update($model)) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        TermsSRL::loadItems($model);
        return $this->renderView($model);
    }
    public function actionDelete($id) {
        $deleted = TermsSRL::delete($id);
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
    public function actionGetPrice() {
        $id = Yii::$app->request->post('id');
        list($saved, $termPrice, $bookPrice, $messages) = TermsSRL::getPrice($id);
        return $this->asJson([
            'saved'     => $saved,
            'termPrice' => $termPrice,
            'bookPrice' => $bookPrice,
            'messages'  => $messages,
        ]);
    }
}