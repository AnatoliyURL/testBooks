<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m240227_134726_create_book_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('book_authors', [
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-book_authors-author_id',
            'book_authors',
            'author_id'
        );

        // add foreign key for table `author`
        $this->addForeignKey(
            'fk-book_authors-author_id',
            'book_authors',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

        // creates index for column `book_id`
        $this->createIndex(
            'idx-book_authors-book_id',
            'book_authors',
            'book_id'
        );

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-book_authors-book_id',
            'book_authors',
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
            'fk-book_authors-book_id',
            'book_authors'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-book_authors-book_id',
            'book_authors'
        );

        // drops foreign key for table `author`
        $this->dropForeignKey(
            'fk-book_authors-author_id',
            'book_authors'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-book_authors-author_id',
            'book_authors'
        );

        $this->dropTable('{{%book_authors}}');
    }
}
