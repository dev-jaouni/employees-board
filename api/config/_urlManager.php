<?php

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [

        [
            'pattern' => 'hr/user/deactivate-employee/<id:\d+>',
            'route' => 'hr/user/deactivate-employee',
            'verb' => 'PATCH'
        ],
    ]
];
