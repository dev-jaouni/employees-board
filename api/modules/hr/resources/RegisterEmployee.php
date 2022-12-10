<?php

namespace api\modules\hr\resources;

use common\models\User;
use common\models\UserProfile;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class RegisterEmployee extends User
{
    /**
     * @return array|array[]
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],

            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            ['phone', 'unique', 'targetClass' => User::class],
            [['phone'], 'string', 'max' => 14],
            [['phone'], 'validatePhone'],
        ]);
    }

    /**
     * @return array|string[]
     */
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'phone',
            'status' => function ($model) {
                return $model->statuses($model->status);
            },
            'userProfile',
        ];
    }
}
