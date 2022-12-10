<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class ArticleFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Article';
    public $depends = [
        ArticleCategoryFixture::class,
        UserFixture::class,
    ];
}
