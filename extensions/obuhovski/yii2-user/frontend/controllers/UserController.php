<?php

namespace obuhovski\user\frontend\controllers;

use app\assets\AppAsset;
use obuhovski\user\models\forms\LoginForm;
use obuhovski\user\models\forms\SignupForm;
use obuhovski\user\models\User;
use Yii;
use obuhovski\blog\models\Post;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PostController implements the CRUD actions for Post model.
 */
class UserController extends Controller
{

    /**
     * Lists all Post models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $user = Yii::$app->getUser()->identity;
//        return $this->render('index',['model'=>$user]);
//    }

    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if (Yii::$app->request->isAjax && $loginForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($loginForm);
        } else {
            if ($loginForm->load(Yii::$app->getRequest()->post()) && $loginForm->login()) {
                return $this->redirect(Yii::$app->user->getReturnUrl());
            }
        }

        return $this->renderAjax('login',['model'=>$loginForm]);

    }

    public function actionSignup()
    {
        $signupForm = new SignupForm();

        if (Yii::$app->request->isAjax && $signupForm->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($signupForm);
        } else {
            if ($signupForm->load(Yii::$app->getRequest()->post()) && $signupForm->signup()) {
                $user = User::findByUsername($signupForm->username);
                Yii::$app->user->login($user);
                return $this->goBack();
            }
        }

        return $this->renderAjax('signup',['model'=>$signupForm]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goBack();

    }

}
