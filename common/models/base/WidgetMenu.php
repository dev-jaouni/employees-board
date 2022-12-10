<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "widget_menu".
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property string $items
 * @property int $status
 */
class WidgetMenu extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'title', 'items'], 'required'],
            [['items'], 'string'],
            [['status'], 'integer'],
            [['key'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'items' => Yii::t('app', 'Items'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\WidgetMenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\WidgetMenuQuery(get_called_class());
    }
}
