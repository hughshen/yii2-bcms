<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'cms' => [
            'class' => 'backend\modules\cms\Module',
        ],
        'shop' => [
            'class' => 'backend\modules\shop\Module',
        ],
        'media' => [
            'class' => 'backend\modules\media\Module',
            'fsComponent' => 'fsFrontend',
            'allowExtensions' => $params['allowExtensions'],
            'allowMimeTypes' => $params['allowMimeTypes'],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'extraFieldInput' => [
            'class' => 'backend\widgets\ExtraFieldInput',
        ],
        'fsFrontend' => [
            'class' => 'creocoder\flysystem\LocalFilesystem',
            'path' => '@frontend/web/uploads',
        ],
    ],
    'params' => $params,
];
