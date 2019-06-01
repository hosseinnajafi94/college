<?php
namespace app\modules\users\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\modules\users\models\SRL\AuthSRL;
class AuthController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['login', 'logout'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['login'],
                        'roles'   => ['?'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['logout'],
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function beforeAction($action) {
        $this->layout = '@app/layouts/login';
        return parent::beforeAction($action);
    }
    public function actions() {
        return [
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_DEBUG ? '2020' : null,
            ],
        ];
    }
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/dashboard/default/index']);
        }
        $model = AuthSRL::newLoginViewModel();
        if (AuthSRL::login($model, Yii::$app->request->post())) {
            return $this->redirect(['/dashboard/default/index']);
        }
        return $this->renderView($model);
    }
    public function actionLogout() {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->redirect(['login']);
    }
    public function actionRole() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $rule = new \app\modules\users\rule\UserGroupRule();
        $auth->add($rule);

        $admin           = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        $clerk           = $auth->createRole('clerk');
        $clerk->ruleName = $rule->name;
        $auth->add($clerk);

        $teacher           = $auth->createRole('teacher');
        $teacher->ruleName = $rule->name;
        $auth->add($teacher);

        $student           = $auth->createRole('student');
        $student->ruleName = $rule->name;
        $auth->add($student);

        $auth->addChild($admin, $clerk);
        $auth->addChild($admin, $teacher);
        $auth->addChild($admin, $student);

        $auth->assign($admin, 1);
        $auth->assign($clerk, 2);
        $auth->assign($teacher, 3);
        $auth->assign($student, 4);
    }
}