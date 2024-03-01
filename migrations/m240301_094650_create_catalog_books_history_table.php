<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_books_history}}`.
 */
class m240301_094650_create_catalog_books_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog_books_history}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
            'event' => $this->integer()->notNull(),
            'created_by' => $this->dateTime()->defaultExpression('NOW()')->append('ON UPDATE NOW()'),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-catalog_books_history-book_id',
            'catalog_books_history',
            'book_id'
        );

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-catalog_books_history-book_id',
            'catalog_books_history',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-catalog_books_history-user_id',
            'catalog_books_history',
            'user_id'
        );

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-catalog_books_history-user_id',
            'catalog_books_history',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user_id`
        $this->dropForeignKey(
            'fk-catalog_books_history-user_id',
            'catalog_books_history'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-catalog_books_history-user_id',
            'catalog_books_history'
        );

        // drops foreign key for table `book_id`
        $this->dropForeignKey(
            'fk-catalog_books_history-book_id',
            'catalog_books_history'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-catalog_books_history-book_id',
            'catalog_books_history'
        );

        $this->dropTable('{{%catalog_books_history}}');
    }
}
