<?php

namespace common\models\query\base;

/**
 * This is the ActiveQuery class for [[\common\models\base\I18nSourceMessage]].
 *
 * @see \common\models\base\I18nSourceMessage
 */
class I18nSourceMessageQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\base\I18nSourceMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\I18nSourceMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
