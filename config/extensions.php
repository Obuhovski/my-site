<?php

use yii\helpers\ArrayHelper;

$extensionsDir = Yii::getAlias('@app/extensions');

$extensions = [
    'dektrium/yii2-user' => [
        'name' => 'dektrium/yii2-user',
        'version' => '0.9.5.0',
        'alias' => [
            '@dektrium/user' => $extensionsDir . '/dektrium/yii2-user',
        ],
        'bootstrap' => 'dektrium\\user\\Bootstrap',
    ],
    'obuhovski/yii2-blog' => [
        'name' => 'obuhovski/yii2-blog',
        'version' => '0.0.1.0',
        'alias' => [
            '@obuhovski/blog' => $extensionsDir . '/obuhovski/yii2-blog',
        ],
    ],
    'obuhovski/yii2-user' => [
        'name' => 'obuhovski/yii2-user',
        'version' => '0.0.1.0',
        'alias' => [
            '@obuhovski/user' => $extensionsDir . '/obuhovski/yii2-user',
        ],
    ],
    'obuhovski/yii2-comments' => [
        'name' => 'obuhovski/yii2-comments',
        'version' => '0.0.1.0',
        'alias' => [
            '@obuhovski/comments' => $extensionsDir . '/obuhovski/yii2-comments',
        ],
    ],
    'obuhovski/yii2-rbac' => [
        'name' => 'obuhovski/yii2-rbac',
        'version' => '0.0.1.0',
        'alias' => [
            '@obuhovski/rbac' => $extensionsDir . '/obuhovski/yii2-rbac',
        ],
    ]
];

foreach ($extensions as $extension) {
    if (isset($extension['alias'])) {
        foreach ($extension['alias'] as $alias => $path) {
            Yii::setAlias($alias, $path);
        }
    }
}

return ArrayHelper::merge(
    require_once Yii::getAlias('@app/vendor/yiisoft/extensions.php'),
    $extensions
);