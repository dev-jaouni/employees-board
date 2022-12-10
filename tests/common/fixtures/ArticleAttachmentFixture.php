<?php

namespace tests\common\fixtures;

use yii\test\ActiveFixture;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class ArticleAttachmentFixture extends ActiveFixture
{
    public $modelClass = 'common\models\ArticleAttachment';
    public $depends = [
        ArticleFixture::class
    ];
}
