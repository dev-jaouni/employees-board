<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string $email
 * @property string|null $phone
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property string|null $oauth_client
 * @property string|null $oauth_client_user_id
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $logged_at
 *
 * @property Article[] $articles
 * @property Article[] $articles0
 * @property UserDevice[] $userDevices
 * @property UserProfile $userProfile
 */
class User extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'auth_key', 'access_token', 'password_hash'], 'required'],
            [['status', 'created_at', 'updated_at', 'logged_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['email', 'password_hash', 'oauth_client', 'oauth_client_user_id'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 14],
            [['access_token'], 'string', 'max' => 40],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['phone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'oauth_client' => Yii::t('app', 'Oauth Client'),
            'oauth_client_user_id' => Yii::t('app', 'Oauth Client User ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'logged_at' => Yii::t('app', 'Logged At'),
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\ArticleQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Articles0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\ArticleQuery
     */
    public function getArticles0()
    {
        return $this->hasMany(Article::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[UserDevices]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\UserDeviceQuery
     */
    public function getUserDevices()
    {
        return $this->hasMany(UserDevice::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserProfile]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\UserProfileQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\UserQuery(get_called_class());
    }
}
