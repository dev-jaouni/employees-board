<?php

namespace api\modules\hr\resources;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class Employee extends User
{
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
