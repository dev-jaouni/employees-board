<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "i18n_message".
 *
 * @property int $id
 * @property string $language
 * @property string|null $translation
 *
 * @property I18nSourceMessage $id0
 */
class I18nMessage extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i18n_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => I18nSourceMessage::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language' => Yii::t('app', 'Language'),
            'translation' => Yii::t('app', 'Translation'),
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\I18nSourceMessageQuery
     */
    public function getId0()
    {
        return $this->hasOne(I18nSourceMessage::class, ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\I18nMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\I18nMessageQuery(get_called_class());
    }
}
