<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class TariffType
 * @package app\models
 *
 * @property int $id
 * @property string $name
 */
class TariffType extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%tariff_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}