<?php

namespace api\modules\hr\resources;

use Yii;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class User extends \common\models\User
{
    /**
     * @return array|array[]
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['password', 'access_token', 'refresh_token', 'device_id'], 'safe']
        ]);
    }

    /**
     * @return array|string[]
     */
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'phone',
            'access_token',
            'refresh_token',
            'userProfile',
        ];
    }

    /**
     * @return bool|\common\models\base\User
     * @throws \yii\base\Exception
     */
    public function login()
    {
        if (!$this->load(Yii::$app->request->post(), '')) {
            return false;
        }

        /** @var  $user self */
        $user = $this->getUser();
        if (!$user) {
            return false;
        }

        if (!$user->validatePassword($this->password)) {
            $this->addError('password', Yii::t('app', 'Invalid Username or Password'));
            return false;
        }

        $user->logged_at = time();

        if (!$user->save()) {
            return false;
        }

        /** @var $user_device UserDevice */
        $user_device = UserDevice::find()->andWhere([
            'device_id' => $this->device_id
        ])->one();

        if (!$user_device) {
            $device_id = Yii::$app->request->headers['device-id'];
            $device_type = Yii::$app->request->headers['x-device-type'];
            $app_version = Yii::$app->request->headers['x-app-version'];
            $user_device = new UserDevice();
            $user_device->device_id = $device_id;
            $user_device->device_type = $device_type;
            $user_device->device_version = $app_version;
        }

        return $user_device->generateTokens($user->id);
    }

    /**
     * @return User|null
     * @throws \yii\base\Exception
     */
    private function getUser()
    {
        /* @var $identity self */
        $identity = self::find()
            ->andWhere(['username' => $this->username])
            ->one();

        if (!$identity) {
            $this->addError('password', Yii::t('app', 'Invalid Username or Password'));
            return null;
        }

        try {
            if (!$identity->validatePassword($this->password)) {
                $this->addError('password', Yii::t('app', 'Invalid Username or Password'));
                return null;
            }
        } catch (\Exception $ex) {
            $this->addError('password', Yii::t('app', 'Invalid Username or Password'));
            return null;
        }

        if ($identity && !$identity->auth_key) {
            $identity->auth_key = \Yii::$app->security->generateRandomString();
            if (!$identity->save()) {
                return null;
            }
        }

        return $identity;
    }
}
