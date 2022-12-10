<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_device".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $access_token
 * @property string|null $refresh_token
 * @property string|null $fcm_token
 * @property string|null $device_id
 * @property string|null $device_type
 * @property string|null $device_version
 * @property int $retries
 * @property string|null $retries_date
 * @property string|null $access_token_expire_date
 * @property string|null $refresh_token_expire_date
 * @property string $language
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class UserDevice extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'retries'], 'integer'],
            [['retries_date', 'access_token_expire_date', 'refresh_token_expire_date', 'created_at', 'updated_at'], 'safe'],
            [['language'], 'string'],
            [['access_token'], 'string', 'max' => 500],
            [['refresh_token', 'fcm_token'], 'string', 'max' => 300],
            [['device_id'], 'string', 'max' => 128],
            [['device_type', 'device_version'], 'string', 'max' => 35],
            [['access_token'], 'unique'],
            [['refresh_token'], 'unique'],
            [['fcm_token'], 'unique'],
            [['device_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'access_token' => Yii::t('app', 'Access Token'),
            'refresh_token' => Yii::t('app', 'Refresh Token'),
            'fcm_token' => Yii::t('app', 'Fcm Token'),
            'device_id' => Yii::t('app', 'Device ID'),
            'device_type' => Yii::t('app', 'Device Type'),
            'device_version' => Yii::t('app', 'Device Version'),
            'retries' => Yii::t('app', 'Retries'),
            'retries_date' => Yii::t('app', 'Retries Date'),
            'access_token_expire_date' => Yii::t('app', 'Access Token Expire Date'),
            'refresh_token_expire_date' => Yii::t('app', 'Refresh Token Expire Date'),
            'language' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\UserDeviceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\UserDeviceQuery(get_called_class());
    }
}
