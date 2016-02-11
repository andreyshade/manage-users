<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\User;
use app\models\Users;
use app\models\LoginForm;
use app\models\Interests;
use app\models\PersonalDetailsForm;
use app\models\UsersInterestsForm;
use app\models\UsersInterests;
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
        $user = Users::findOne([Users::FIELD_USER_ID => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
			'query' => Users::find()->where(['!=', Users::FIELD_USER_ID, (Yii::$app->user->id ? Yii::$app->user->id : 0)]),
			'pagination' => [
				'pageSize' => 24,
			],
		]);
        return $this->render('index' , [
            'user' => $user,
            'dataProvider' => $dataProvider
        ]);
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PersonalDetailsForm();
        if ($user = Users::findOne(Yii::$app->user->id)) {
            $model->initForm($user);
        }

        $interests_model = new UsersInterestsForm();

        $interests = UsersInterests::find()->where([UsersInterests::FIELD_USER_ID => Yii::$app->user->id])->all();

        if ($model->load(Yii::$app->request->post(), 'PersonalDetailsForm') && $model->save()) {
            Yii::$app->session->setFlash('success', 'Personal details update successfully');
            return $this->redirect('personal-details');
        }

        if ($interests_model->load(Yii::$app->request->post(), 'UsersInterestsForm') && $interests_model->save()) {
            Yii::$app->session->setFlash('success', 'Interest added successfully');
            return $this->redirect('personal-details');
        }

        return $this->render('personal_details', [
            'model' => $model,
            'interests_model' => $interests_model,
            'interests' => $interests
        ]);
    }

    public function actionDeleteUserInterest($interest_id)
    {
        UsersInterests::deleteAll([UsersInterests::FIELD_INTEREST_ID => $interest_id, UsersInterests::FIELD_USER_ID => Yii::$app->user->id]);
//        If interest don't assign to another user, remove it
        if (!UsersInterests::findAll([UsersInterests::FIELD_INTEREST_ID => $interest_id])){
            Interests::deleteAll([Interests::FIELD_INTEREST_ID => $interest_id]);
        }

        Yii::$app->session->setFlash('success', 'Interest deleted successfully');
        return $this->redirect('personal-details');
    }
}
