<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "i18n_source_message".
 *
 * @property int $id
 * @property string|null $category
 * @property string|null $message
 *
 * @property I18nMessage[] $i18nMessages
 */
class I18nSourceMessage extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i18n_source_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * Gets query for [[I18nMessages]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\I18nMessageQuery
     */
    public function getI18nMessages()
    {
        return $this->hasMany(I18nMessage::class, ['id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\I18nSourceMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\I18nSourceMessageQuery(get_called_class());
    }
}
