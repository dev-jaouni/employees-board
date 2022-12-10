<?php

namespace api\modules\hr\resources;

use Yii;
use common\models\User;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class ContactInfo extends User
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'filter' => function ($query) {
                $query->andWhere(['not', ['id' => $this->id]]);
            }],
            ['phone', 'unique',
                'targetClass' => parent::class,
                'message' => Yii::t('backend', 'This phone has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => $this->id]]);
                }
            ],
            [['phone'], 'validatePhone'],
        ]);
    }


    public function fields()
    {
        return [
            'first_name' => function ($model) {
                /** @var $model self */
                return $model->userProfile->first_name;
            },
            'middle_name' => function ($model) {
                /** @var $model self */
                return $model->userProfile->middle_name;
            },
            'last_name' => function ($model) {
                /** @var $model self */
                return $model->userProfile->last_name;
            },
            'email',
            'phone',
            'job_title' => function ($model) {
                /** @var $model self */
                return $model->userProfile->last_name;
            },
        ];
    }
}
