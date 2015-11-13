<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language'=>'zh-CN',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@backend/views/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    'idField' => 'id'
                ]
            ],
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],

        // 'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //             '@backend/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
        //         ],
        //     ],
        // ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'enableStrictParsing' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //         ['class' => 'yii\rest\UrlRule', 'controller' => 'school'],
        //         ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
        //         ['class' => 'yii\rest\UrlRule', 'controller' => 'student'],
        //         ['class' => 'yii\rest\UrlRule', 'controller' => 'loan'],
        //     ],
        // ],
        // 'request' => [
        //     'parsers' => [
        //         'application/json' => 'yii\web\JsonParser',
        //     ]
        // ]
        // 'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //             '@dektrium/user/views' => '@backend/views/user'
        //         ],
        //     ],
        // ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'cn',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'admin/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
            'user/index',
            'user/login',
            'user/security/login',
            'user/logout',
            'user/security/logout',
            'user/register',
            'user/registration/register',
            'user/registration/confirm',
            'user/registration/resend',
            'user/registration/connect',

            // 'site/index',
            // 'site/about',
            // 'site/contact',
            // 'site/signup',
            // 'site/logout',
            // 'site/login',

            //'gii/*',
            'loan/*',
            //'debug/*'
        ]
    ],

];
