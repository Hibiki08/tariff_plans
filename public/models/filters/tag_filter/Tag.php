<?php

namespace app\models\filters\tag_filter;

/**
 * Enum Tag
 * @package app\models\filters\tag_filter
 */
enum Tag
{
    case IMG;
    case SCRIPT;

    /* some other tags */

    /**
     * Returns tag name
     *
     * @return string
     */
    public function tagName(): string
    {
        return match ($this) {
            self::IMG => 'img',
            self::SCRIPT => 'script',
        };
    }
}
