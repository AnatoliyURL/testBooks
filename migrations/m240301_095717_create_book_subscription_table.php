<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_subscription}}`.
 */
class m240301_095717_create_book_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_subscription}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'phone' => $this->char(13)->notNull()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-book_subscription-book_id',
            'book_subscription',
            'book_id'
        );

        // add foreign key for table `book`
        $this->addForeignKey(
            'fk-book_subscription-book_id',
            'book_subscription',
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
            'fk-book_subscription-book_id',
            'book_subscription'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            'idx-book_subscription-book_id',
            'book_subscription'
        );

        $this->dropTable('{{%book_subscription}}');
    }
}
