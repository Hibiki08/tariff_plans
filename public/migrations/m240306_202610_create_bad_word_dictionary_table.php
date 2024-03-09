<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bad_words}}`.
 */
class m240306_202610_create_bad_word_dictionary_table extends Migration
{
    const TABLE_BAD_WORD = '{{%bad_word_dictionary}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_BAD_WORD, [
            'id' => $this->primaryKey()->unsigned(),
            'word' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_BAD_WORD);
    }
}
