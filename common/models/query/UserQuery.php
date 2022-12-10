<?php

namespace common\models\query;

use common\models\User;

/**
 * Class UserQuery
 * @package common\models\query
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class UserQuery extends base\UserQuery
{
    /**
     * @return $this
     */
    public function notDeleted()
    {
        $this->andWhere(['!=', 'status', User::STATUS_DELETED]);
        return $this;
    }

    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => User::STATUS_ACTIVE]);
        return $this;
    }
}