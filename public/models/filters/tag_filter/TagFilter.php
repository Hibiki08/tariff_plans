<?php

namespace app\models\filters\tag_filter;

use JetBrains\PhpStorm\NoReturn;
use yii\validators\Validator;

/**
 * Class TagFilter
 * @package app\models\filters
 */
class TagFilter extends Validator
{
    /**
     * @var Tag[]
     */
    public array $tagsToRemove = [];

    public function init(): void
    {
        parent::init();

        if (empty($this->tagsToRemove)) {
            throw new \InvalidArgumentException('The "tagsToRemove" property must be set.');
        }

        foreach ($this->tagsToRemove as $tag) {
            if (!$tag instanceof Tag) {
                throw new \InvalidArgumentException('Tag not found');
            }
        }
    }

    /**
     * Filter validation
     */
    #[NoReturn] public function validateAttribute($model, $attribute): void
    {
        $model->$attribute = $this->applyFilter($model->$attribute);
    }

    /**
     * @param string $value
     * @return string
     */
    protected function applyFilter(string $value): string
    {
        $patterns = array_map(function ($tag) {
            return "/<\/?{$tag->tagName()}([^>]+)?\>/i";
        }, $this->tagsToRemove);

        return trim(preg_replace($patterns, '', $value));
    }
}