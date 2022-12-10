<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "system_db_migration".
 *
 * @property string $version
 * @property int|null $apply_time
 */
class SystemDbMigration extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_db_migration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['version'], 'required'],
            [['apply_time'], 'integer'],
            [['version'], 'string', 'max' => 180],
            [['version'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'version' => Yii::t('app', 'Version'),
            'apply_time' => Yii::t('app', 'Apply Time'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\SystemDbMigrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\SystemDbMigrationQuery(get_called_class());
    }
}
