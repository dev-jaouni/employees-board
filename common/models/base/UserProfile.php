<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $job_title
 * @property string|null $avatar_path
 * @property string|null $avatar_base_url
 * @property string $locale
 * @property int|null $gender
 *
 * @property User $user
 */
class UserProfile extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locale'], 'required'],
            [['gender'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'job_title', 'avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            [['locale'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'job_title' => Yii::t('app', 'Job Title'),
            'avatar_path' => Yii::t('app', 'Avatar Path'),
            'avatar_base_url' => Yii::t('app', 'Avatar Base Url'),
            'locale' => Yii::t('app', 'Locale'),
            'gender' => Yii::t('app', 'Gender'),
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
     * @return \common\models\query\base\UserProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\UserProfileQuery(get_called_class());
    }
}
