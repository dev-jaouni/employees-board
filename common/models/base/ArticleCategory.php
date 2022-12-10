<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string|null $body
 * @property int|null $parent_id
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ArticleCategory[] $articleCategories
 * @property Article[] $articles
 * @property ArticleCategory $parent
 */
class ArticleCategory extends \common\components\BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'title'], 'required'],
            [['body'], 'string'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 512],
            [['slug'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[ArticleCategories]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\ArticleCategoryQuery
     */
    public function getArticleCategories()
    {
        return $this->hasMany(ArticleCategory::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\ArticleQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\base\ArticleCategoryQuery
     */
    public function getParent()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'parent_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\base\ArticleCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\base\ArticleCategoryQuery(get_called_class());
    }
}
