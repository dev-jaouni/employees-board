<?php

namespace common\models\query\base;

/**
 * This is the ActiveQuery class for [[\common\models\base\I18nMessage]].
 *
 * @see \common\models\base\I18nMessage
 */
class I18nMessageQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\base\I18nMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\I18nMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
