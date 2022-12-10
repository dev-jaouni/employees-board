<?php declare(strict_types=1);


namespace common\models\query;

use common\models\Page;

class PageQuery extends base\PageQuery
{
    /**
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['status' => Page::STATUS_PUBLISHED]);
        return $this;
    }
}
