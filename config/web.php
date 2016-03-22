<?php
use yii\base\Event;
use yii\web\Controller;

$params = require(__DIR__ . '/params.php');
Yii::setAlias('app',dirname(__DIR__));

Event::on(Controller::className(), Controller::EVENT_BEFORE_ACTION, function ($event) {
    if ($user = Yii::$app->user->identity) {
        $user->last_visit = (new DateTime())->format('Y-m-d H:i:s');
        $user->save(false);
    }
});

$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    //'layout' => '@app/modules/main',
    'viewPath' => dirname(__DIR__) . '/modules/main/views',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','admin'],
    'extensions' => require_once Yii::getAlias('@app/config/extensions.php'),
    'as access' => [
        'class' => 'mdm\admin\classes\AccessControl',
        'allowActions' => [
            'main/*',
            'blog/*',
            'user/user/login',

            'user/user/logout',
            '*',
            'admin/*',
            'debug/*',
        ]
    ],
    'modules' => [
        'backend' => [
            'class' => 'app\modules\backend\Module',
            'layout' => 'main',
            'modules' => [
                'blog' => [
                    'class' => 'obuhovski\blog\backend\Module'
                ],
                'comments' => [
                    'class' => 'obuhovski\comments\backend\Module'
                ]
            ]
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'obuhovski\user\frontend\Module',
        ],
        'blog' => [
            'class' => 'obuhovski\blog\frontend\Module',

        ]
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '338669426716-6jqajl5vjk69hqf762fa3h978o9umb78.apps.googleusercontent.com',
                    'clientSecret' => '8i8TqWAhNOrOaeTgVkAJ8Vnj',
                    'returnUrl' => 'http://my-site.dev/user/auth/auth?authclient=google'
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '581024815383856',
                    'clientSecret' => 'dd67420e30f19051f9185e42fcaf79b9',
                ],
                'VKontakte' => [
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '5316979',
                    'clientSecret' => 'nqg9oQrwmgzDGMDyF65M',
                ],
                // и т.д.
            ],
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => [
                // uncomment this to use streams in safe_mode
                //'useStreamsFallback' => true,
            ],
            'services' => [ // You can change the providers and their classes.
                'google' => [
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
                    'clientId' => '338669426716-6jqajl5vjk69hqf762fa3h978o9umb78.apps.googleusercontent.com',
                    'clientSecret' => '8i8TqWAhNOrOaeTgVkAJ8Vnj',
//                    'returnUrl' => 'http://my-site.dev/user/auth/auth?authclient=google',
                    'title' => 'Google',
                ],
                'facebook' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'nodge\eauth\services\FacebookOAuth2Service',
                    'clientId' => '961319667270316',
                    'clientSecret' => 'b1f26ae6a392c49283f7a942c1702e3d',
                ],
                'vkontakte' => [
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
                    'clientId' => '5316979',
                    'clientSecret' => 'nqg9oQrwmgzDGMDyF65M',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'G_h-9Qw_MFigoDS8FHjoEiFHAxoqkI4s',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'obuhovski\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/user/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => 'main/site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'main/site/index',
//                '<module:[\w-]+>' => '<module>/frontend/post/index',
//
//                '<module:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<module>/frontend/post/<action>',
//                '<module:[\w-]+>/<action:[\w-]+>' => '<module>/frontend/post/<action>',
//
//                '<module:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<module>/frontend/<controller>/<action>',
//                '<module:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>' => '<module>/frontend/<controller>/<action>'
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
