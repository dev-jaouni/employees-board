<?php

return [
    [
        'parent' => 'employee',
        'child' => 'editOwnModel',
    ],
    [
        'parent' => 'hr_manager',
        'child' => 'loginToBackend',
    ],
    [
        'parent' => 'administrator',
        'child' => 'hr_manager',
    ],
    [
        'parent' => 'hr_manager',
        'child' => 'employee',
    ],
];
