<?php

namespace app\modules\main\controllers;

use dektrium\user\models\User;
use obuhovski\blog\models\Post;
use samdark\sitemap\Sitemap;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $sitemap = new Sitemap(Yii::getAlias('@app/web'). '/sitemap.xml');

        $posts = Post::findAll(['status' => 1]);
        foreach ($posts as $post) {
            $sitemap->addItem(Url::to(['/blog/post/view','slug' => $post->slug],true),time(),Sitemap::DAILY);
        }
        $sitemap->write();
        return $this->redirect(['/blog']);
        //return Yii::$app->response->redirect('/blog',302,false);
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAbouttt()
    {
        return 'О сайте';
        //return $this->render('index');
    }

}
