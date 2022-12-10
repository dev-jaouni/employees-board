<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_device}}`.
 */
class m221208_165901_create_user_device_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_device}}', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer(),
            'access_token' => $this->string(500),
            'refresh_token' => $this->string(300),
            'fcm_token' => $this->string(300),
            'device_id' => $this->string(128),
            'device_type' => $this->string(35),
            'device_version' => $this->string(35),
            'retries' => $this->tinyInteger(2)->notNull()->defaultValue(0),
            'retries_date' => $this->dateTime(),
            'access_token_expire_date' => $this->dateTime(),
            'refresh_token_expire_date' => $this->dateTime(),
            'language' => "ENUM('ar', 'en') NOT NULL DEFAULT 'ar'",
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('fk_user_device_user_id_user_id', '{{%user_device}}', 'user_id', '{{%user}}', 'id');

        $this->createIndex('ndx_user_device_access_token', '{{%user_device}}', 'access_token', true);
        $this->createIndex('ndx_user_device_refresh_token', '{{%user_device}}', 'refresh_token', true);
        $this->createIndex('ndx_user_device_fcm_token', '{{%user_device}}', 'fcm_token', true);
        $this->createIndex('ndx_ud_device_id', '{{%user_device}}', 'device_id', true);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_device_user_id_user_id', '{{%user_device}}');

        $this->dropTable('{{%user_device}}');
    }
}
