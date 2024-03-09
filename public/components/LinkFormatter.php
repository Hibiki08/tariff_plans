<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Class LinkFormatter
 * @package app\components
 */
class LinkFormatter extends Component
{
    /**
     * Returns formatted text with links
     *
     * @param string $text
     * @return string
     */
    public static function format(string $text): string
    {
       return preg_replace_callback('/(http|https):\/\/(www\.)?\S+/i', function ($matches) {
           return Yii::$app->formatter->asUrl($matches[0]);
       }, $text);
    }
}