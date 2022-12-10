<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "file_storage_item".
 *
 * @property int $id
 * @property string $component
 * @property string $base_url
 * @property string $path
 * @property string|null $type
 * @property int|null $size
 * @property string|null $name
 * @property string|null $upload_ip
 * @property int $created_at
 */
class FileStorageItem extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_storage_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['component', 'base_url', 'path', 'created_at'], 'required'],
            [['size', 'created_at'], 'integer'],
            [['component', 'type', 'name'], 'string', 'max' => 255],
            [['base_url', 'path'], 'string', 'max' => 1024],
            [['upload_ip'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'component' => Yii::t('app', 'Component'),
            'base_url' => Yii::t('app', 'Base Url'),
            'path' => Yii::t('app', 'Path'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'name' => Yii::t('app', 'Name'),
            'upload_ip' => Yii::t('app', 'Upload Ip'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\FileStorageItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\FileStorageItemQuery(get_called_class());
    }
}
