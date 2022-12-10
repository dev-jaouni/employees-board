<?php

namespace common\models;

use Yii;
use yii\db\Expression;

/**
 * Class UserDevice
 * @package common\models
 */
class UserDevice extends base\UserDevice
{
    /**
     * @param $access_token
     * @param $refresh_token
     * @return array|null|self
     */
    public static function checkUserTokens($access_token, $refresh_token)
    {
        return self::find()
            ->innerJoinWith(['user' => function ($q) {
                $q->active();
            }])
            ->where([
                UserDevice::tableName() . '.access_token' => $access_token,
                UserDevice::tableName() . '.refresh_token' => $refresh_token
            ])->one();
    }

    /**
     * @param null $user_id
     * @return bool|base\User
     * @throws \yii\base\Exception
     */
    public function generateTokens($user_id = null)
    {
        if ($user_id)
            $this->user_id = $user_id;

        $this->language = Yii::$app->language;
        $this->access_token = Yii::$app->security->generateRandomString(100) . time();
        $this->refresh_token = Yii::$app->security->generateRandomString(100) . time();
        $this->access_token_expire_date = new Expression('NOW() + INTERVAL 1 DAY');
        $this->refresh_token_expire_date = new Expression('NOW() + INTERVAL 7 DAY');

        if (!$this->save()) {
            return false;
        }

        if ($this->user->status == User::STATUS_ACTIVE) {
            $this->user->access_token = $this->access_token;
            $this->user->refresh_token = $this->refresh_token;
        }

        return $this->user;
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
