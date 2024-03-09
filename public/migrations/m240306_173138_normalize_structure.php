<?php

use yii\db\Migration;

/**
 * Class m240306_173138_normalize_structure
 */
class m240306_173138_normalize_structure extends Migration
{
    const TABLE_TARIFF = '{{%tariff}}';
    const TABLE_TARIFF_TYPE = '{{%tariff_type}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->createTable(self::TABLE_TARIFF, [
           'id' => $this->primaryKey()->unsigned(),
           'name' => $this->string(255)->notNull(),
           'type_id' => $this->integer()->unsigned()->notNull()->comment('Tariff type'),
           'price' => $this->decimal(10, 2)->notNull()->comment('Price in USD'),
           'description' => $this->string(255)->notNull(),
           'is_active' => $this->boolean()->notNull()->defaultValue(0)->comment('Whether to show in the list of tariffs'),

        ]);

        $this->addForeignKey(
            'fk_tariff_type',
            self::TABLE_TARIFF,
            'type_id',
            self::TABLE_TARIFF_TYPE,
            'id'
        );

        $this->insertData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_TARIFF);
    }

    private function insertData()
    {
        $this->execute("
    INSERT INTO " . self::TABLE_TARIFF . " (name, type_id, price, description, is_active)
    SELECT 
        TRIM(SUBSTRING_INDEX(ot.name_and_price, '(', 1)), /* name */
        tt.id, /* type_id */
        CAST(REGEXP_SUBSTR(name_and_price, '[0-9]+') AS DECIMAL(10,2)), /* price */
        ot.description, 
        ot.is_active 
    FROM old_tariff ot
    JOIN tariff_type tt ON tt.name = ot.type_name
"
        );
    }
}
