<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "rbac_auth_rule".
 *
 * @property string $name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property RbacAuthItem[] $rbacAuthItems
 */
class RbacAuthRule extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_auth_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[RbacAuthItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthItemQuery
     */
    public function getRbacAuthItems()
    {
        return $this->hasMany(RbacAuthItem::class, ['rule_name' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\RbacAuthRuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\RbacAuthRuleQuery(get_called_class());
    }
}
