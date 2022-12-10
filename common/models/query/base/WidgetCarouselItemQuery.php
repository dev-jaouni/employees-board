<?php

namespace common\models\query\base;

/**
 * This is the ActiveQuery class for [[\common\models\base\WidgetCarouselItem]].
 *
 * @see \common\models\base\WidgetCarouselItem
 */
class WidgetCarouselItemQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\base\WidgetCarouselItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\WidgetCarouselItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
