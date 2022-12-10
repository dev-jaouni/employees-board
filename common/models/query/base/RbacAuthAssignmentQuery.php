<?php

namespace common\models\query\base;

/**
 * This is the ActiveQuery class for [[\common\models\base\RbacAuthAssignment]].
 *
 * @see \common\models\base\RbacAuthAssignment
 */
class RbacAuthAssignmentQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\base\RbacAuthAssignment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\RbacAuthAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
