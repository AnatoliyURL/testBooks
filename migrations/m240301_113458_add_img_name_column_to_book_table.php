<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%book}}`.
 */
class m240301_113458_add_img_name_column_to_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%book}}', 'cover', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%book}}', 'cover');
    }
}
