<?php

namespace app\models\filters;

use app\models\dictionaries\BadWordDictionary;
use yii\validators\Validator;

/**
 * Class BadWordFilter
 * @package app\validators
 */
class BadWordFilter extends Validator
{
    /**
     * With what to replace the forbidden word
     *
     * @var string
     */
    public string $replacement = '***';

    /**
     * Filter validation
     */
    public function validateAttribute($model, $attribute): void
    {
        $model->$attribute = $this->applyFilter($model->$attribute);
    }

    /**
     * @param string $value
     * @return string
     */
    protected function applyFilter(string $value): string
    {
        $badWords = $this->getBadWords();
        if (empty($badWords)) {
            return $value;
        }

        $patterns = array_map(function ($word) {
            return '/' . preg_quote($word, '/') . '/iu';
        }, $badWords);

        return preg_replace($patterns, $this->replacement, $value);
    }

    /**
     * @return array
     */
    private function getBadWords(): array
    {
        return BadWordDictionary::find()->select('word')->column();
    }
}