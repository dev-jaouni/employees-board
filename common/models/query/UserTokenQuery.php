<?php

namespace common\models\query;

/**
 * Class UserTokenQuery
 * @package common\models\query
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class UserTokenQuery extends base\UserTokenQuery
{
    /**
     * @return $this
     */
    public function notExpired()
    {
        $this->andWhere(['>', 'expire_at', time()]);
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function byType($type)
    {
        $this->andWhere(['type' => $type]);
        return $this;
    }

    /**
     * @param $token
     * @return $this
     */
    public function byToken($token)
    {
        $this->andWhere(['token' => $token]);
        return $this;
    }
}