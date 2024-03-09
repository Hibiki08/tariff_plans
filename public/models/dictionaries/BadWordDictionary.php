<?php

namespace app\models\dictionaries;

use yii\db\ActiveRecord;

/**
 * Class BadWordDictionary
 * @package app\models\dictionaries
 *
 * @property int $id
 * @property string $word
 */
class BadWordDictionary extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%bad_word_dictionary}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['word'], 'required'],
            [['word'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
        ];
    }
}