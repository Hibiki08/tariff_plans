<?php

namespace app\models;

use app\models\filters\BadWordFilter;
use app\models\filters\tag_filter\Tag;
use app\models\filters\tag_filter\TagFilter;
use Yii;
use yii\db\ActiveRecord;

/**
 * Class Tariff
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 * @property float $price
 * @property string $description
 * @property bool $is_active
 */
class Tariff extends ActiveRecord
{
    const SCENARIO_FILTERING = 'filtering';

    const EVENT_AFTER_TARIFF_CREATED = 'afterTariffCreated';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%tariff}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'type_id', 'price', 'description'], 'required'],
            [['price'], 'number'],
            [['is_active'], 'boolean'],
            [['name', 'description'], 'string', 'max' => 255],
            [['type_id'], 'integer'],
            [['type_id'], 'exist', 'targetClass' => TariffType::class, 'targetAttribute' => ['type_id' => 'id']],
            [['name', 'description'], 'filter', 'filter' => 'trim'],
            ['description', BadWordFilter::class, 'on' => self::SCENARIO_FILTERING],
            ['description', TagFilter::class, 'tagsToRemove' => [Tag::IMG], 'on' => self::SCENARIO_FILTERING],
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
            'type_id' => 'Type ID',
            'price' => 'Price',
            'description' => 'Description',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function afterValidate(): void
    {
        if (!$this->hasErrors() && $this->scenario === self::SCENARIO_FILTERING) {
            $this->description = Yii::$app->linkFormatter->format($this->description);
        }
        parent::afterValidate();
    }
}