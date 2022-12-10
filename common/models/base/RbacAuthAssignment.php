<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "rbac_auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int|null $created_at
 *
 * @property RbacAuthItem $itemName
 */
class RbacAuthAssignment extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rbac_auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('app', 'Item Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[ItemName]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\RbacAuthItemQuery
     */
    public function getItemName()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'item_name']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\RbacAuthAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\RbacAuthAssignmentQuery(get_called_class());
    }
}
