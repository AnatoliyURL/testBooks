<?php

use yii\db\Migration;

/**
 * Class m240227_124254_create_book_table
 */
class m240227_124254_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date_released' => $this->date()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->char(13),
            'cover' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('book');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240227_124254_create_book_table cannot be reverted.\n";

        return false;
    }
    */
}
