<?php

namespace app\components;

use app\models\events\TariffEvent;
use app\models\Tariff;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

/**
 * Class EventSubscriber
 * @package app\components
 */
class EventSubscriber extends Component implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap($app): void
    {
        Event::on(
            Tariff::class,
            Tariff::EVENT_AFTER_TARIFF_CREATED,
            function (TariffEvent $event) {
                $event->onTariffCreated();
            }
        );
    }
}