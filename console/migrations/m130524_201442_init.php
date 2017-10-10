<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // user
        $this->createTable('{{%user}}', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'api_token'            => $this->string()->unique(),
            'status'               => $this->smallInteger()->notNull()->defaultValue(10),
            'role'                 => $this->string()->notNull(),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
                ], $tableOptions);
        $this->createIndex('index-user-status', 'user', 'status');
        $this->createIndex('index-user-username', 'user', 'username');
        $this->createIndex('index-user-email', 'user', 'email');

        // user metadata
        $this->createTable('{{%user_meta}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'meta_key'   => $this->string()->notNull(),
            'meta_value' => $this->text(),
                ], $tableOptions);
        $this->addForeignKey('fk-user_meta-user_id', 'user_meta', 'user_id', 'user', 'id', 'CASCADE');
        $this->createIndex('index-user_meta-user_id', 'user_meta', 'user_id');
        $this->createIndex('index-user_meta-meta_key', 'user_meta', 'meta_key');

        // user info
        $this->createTable('{{%setting}}', [
            'id'                  => $this->primaryKey(),
            'user_id'             => $this->integer()->notNull(),
            'name'                => $this->string(),
            'from_name'           => $this->string(),
            'from_email'          => $this->string(),
            'reply_to'            => $this->string(),
            'smtp_host'           => $this->string(),
            'smtp_port'           => $this->string(),
            'smtp_ssl'            => $this->string(),
            'smtp_username'       => $this->string(),
            'smtp_password'       => $this->string(),
            'allowed_attachments' => $this->string(),
            'logo'                => $this->string(),
            'created_at'          => $this->integer()->notNull(),
            'updated_at'          => $this->integer()->notNull(),
                ], $tableOptions);
        $this->addForeignKey('fk-setting-user_id', 'setting', 'user_id', 'user', 'id', 'CASCADE');
        $this->createIndex('index-setting-user_id', 'setting', 'user_id');


        $this->createTable('{{%campaign}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'name'       => $this->string(255)->notNull(),
            'from_name'  => $this->string(255)->notNull(),
            'from_email' => $this->string(10)->notNull(),
            'reply_to'   => $this->string(255)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
        $this->addForeignKey('fk-campaign-user_id', 'campaign', 'user_id', 'user', 'id', 'CASCADE');
        $this->createIndex('index-campaign-user_id', 'campaign', 'user_id');

        $this->createTable('{{%template}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'name'       => $this->string(255)->notNull(),
            'html'       => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
        $this->addForeignKey('fk-template-user_id', 'template', 'user_id', 'user', 'id', 'CASCADE');
        $this->createIndex('index-template-user_id', 'template', 'user_id');
    }

    public function down()
    {
        
    }

}
