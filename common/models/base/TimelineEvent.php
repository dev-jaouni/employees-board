<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "timeline_event".
 *
 * @property int $id
 * @property string $application
 * @property string $category
 * @property string $event
 * @property string|null $data
 * @property int $created_at
 */
class TimelineEvent extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timeline_event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application', 'category', 'event', 'created_at'], 'required'],
            [['data'], 'string'],
            [['created_at'], 'integer'],
            [['application', 'category', 'event'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'application' => Yii::t('app', 'Application'),
            'category' => Yii::t('app', 'Category'),
            'event' => Yii::t('app', 'Event'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\TimelineEventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\TimelineEventQuery(get_called_class());
    }
}
