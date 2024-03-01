<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_books}}`.
 */
class m240301_094610_create_catalog_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog_books}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'count' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `book_id`
        $this->createIndex(
            'idx-catalog_books-book_id',
            'catalog_books',
            'book_id'
        );

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-catalog_books-book_id',
            'catalog_books',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `book_id`
        $this->dropForeignKey(
            'fk-catalog_books-book_id',
            'catalog_books'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-catalog_books-book_id',
            'catalog_books'
        );

        $this->dropTable('{{%catalog_books}}');
    }
}
