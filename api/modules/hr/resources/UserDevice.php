<?php

namespace api\modules\hr\resources;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class UserDevice extends \common\models\UserDevice
{
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->with(['userProfile']);
    }
}
