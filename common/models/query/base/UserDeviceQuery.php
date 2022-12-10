<?php

namespace common\models\query\base;

/**
 * This is the ActiveQuery class for [[\common\models\base\UserDevice]].
 *
 * @see \common\models\base\UserDevice
 */
class UserDeviceQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\base\UserDevice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\UserDevice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
