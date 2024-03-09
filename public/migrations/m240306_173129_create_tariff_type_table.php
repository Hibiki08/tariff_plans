<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tariff_type}}`.
 */
class m240306_173129_create_tariff_type_table extends Migration
{
    const TABLE_TARIFF_TYPE = '{{%tariff_type}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_TARIFF_TYPE, [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->insertData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_TARIFF_TYPE);
    }

    private function insertData()
    {
        $this->execute('
            INSERT INTO ' . self::TABLE_TARIFF_TYPE . ' (name)
            SELECT DISTINCT type_name FROM old_tariff'
        );
    }
}
