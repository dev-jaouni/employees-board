<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "rbac_auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $rule_name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property RbacAuthItem[] $children
 * @property RbacAuthItem[] $parents
 * @property RbacAuthAssignment[] $rbacAuthAssignments
 * @property RbacAuthItemChild[] $rbacAuthItemChildren
 * @property RbacAuthItemChild[] $rbacAuthItemChildren0
 * @property RbacAuthRule $ruleName
 */
class RbacAuthItem extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthRule::class, 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Children]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthItemQuery
     */
    public function getChildren()
    {
        return $this->hasMany(RbacAuthItem::class, ['name' => 'child'])->viaTable('rbac_auth_item_child', ['parent' => 'name']);
    }

    /**
     * Gets query for [[Parents]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthItemQuery
     */
    public function getParents()
    {
        return $this->hasMany(RbacAuthItem::class, ['name' => 'parent'])->viaTable('rbac_auth_item_child', ['child' => 'name']);
    }

    /**
     * Gets query for [[RbacAuthAssignments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthAssignmentQuery
     */
    public function getRbacAuthAssignments()
    {
        return $this->hasMany(RbacAuthAssignment::class, ['item_name' => 'name']);
    }

    /**
     * Gets query for [[RbacAuthItemChildren]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthItemChildQuery
     */
    public function getRbacAuthItemChildren()
    {
        return $this->hasMany(RbacAuthItemChild::class, ['parent' => 'name']);
    }

    /**
     * Gets query for [[RbacAuthItemChildren0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthItemChildQuery
     */
    public function getRbacAuthItemChildren0()
    {
        return $this->hasMany(RbacAuthItemChild::class, ['child' => 'name']);
    }

    /**
     * Gets query for [[RuleName]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthRuleQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(RbacAuthRule::class, ['name' => 'rule_name']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\RbacAuthItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\RbacAuthItemQuery(get_called_class());
    }
}
