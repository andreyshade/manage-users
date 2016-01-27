<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegistrationForm;

class SiteController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $registration_model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post(), 'LoginForm') && $model->login()) {
            return $this->goBack();
        }
        if ($registration_model->load(Yii::$app->request->post(), 'RegistrationForm') && $registration_model->register()) {
            return $this->redirect('personal-details');
        }
        return $this->render('login', [
            'model' => $model,
            'registration_model' => $registration_model
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPersonalDetails() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('personal_details');
    }
}
