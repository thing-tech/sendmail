<?php

use yii\db\Migration;

class m130524_201442_init extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        // product
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'number' => $this->integer()->null(),
            'price' => $this->integer()->null(),
            'sale' => $this->integer()->null(),
            'fake' => $this->integer()->null(),
            'thumbnail' => $this->string()->null(),
            'images' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'author' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
        $this->addForeignKey('fk-product-author', 'product', 'author', 'user', 'id');
        $this->createIndex('index-product-author', 'product', 'author');
        // relationship
        $this->createTable('{{%relationship}}', [
            'term_id' => $this->integer()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);
        $this->addForeignKey('fk-relationship-object_id', 'relationship', 'object_id', 'product', 'id', 'CASCADE');
    }

    public function down() {
        
    }

}
