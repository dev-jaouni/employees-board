<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property int $id
 * @property string $key
 * @property int|null $status
 *
 * @property WidgetCarouselItem[] $widgetCarouselItems
 */
class WidgetCarousel extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_carousel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['status'], 'integer'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[WidgetCarouselItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\WidgetCarouselItemQuery
     */
    public function getWidgetCarouselItems()
    {
        return $this->hasMany(WidgetCarouselItem::class, ['carousel_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\WidgetCarouselQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\WidgetCarouselQuery(get_called_class());
    }
}
