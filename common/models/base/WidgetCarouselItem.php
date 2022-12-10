<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "widget_carousel_item".
 *
 * @property int $id
 * @property int $carousel_id
 * @property string|null $base_url
 * @property string|null $path
 * @property string|null $asset_url
 * @property string|null $type
 * @property string|null $url
 * @property string|null $caption
 * @property int $status
 * @property int|null $order
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property WidgetCarousel $carousel
 */
class WidgetCarouselItem extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_carousel_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carousel_id'], 'required'],
            [['carousel_id', 'status', 'order', 'created_at', 'updated_at'], 'integer'],
            [['base_url', 'path', 'asset_url', 'url', 'caption'], 'string', 'max' => 1024],
            [['type'], 'string', 'max' => 255],
            [['carousel_id'], 'exist', 'skipOnError' => true, 'targetClass' => WidgetCarousel::class, 'targetAttribute' => ['carousel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'carousel_id' => Yii::t('app', 'Carousel ID'),
            'base_url' => Yii::t('app', 'Base Url'),
            'path' => Yii::t('app', 'Path'),
            'asset_url' => Yii::t('app', 'Asset Url'),
            'type' => Yii::t('app', 'Type'),
            'url' => Yii::t('app', 'Url'),
            'caption' => Yii::t('app', 'Caption'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Carousel]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\WidgetCarouselQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(WidgetCarousel::class, ['id' => 'carousel_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\WidgetCarouselItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\WidgetCarouselItemQuery(get_called_class());
    }
}
