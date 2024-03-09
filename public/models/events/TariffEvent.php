<?php

namespace app\models\events;

use Yii;
use yii\base\Event;

/**
 * Class TariffEvent
 * @package app\models\events
 */
class TariffEvent extends Event
{
    /**
     * Sends email to admin when new tariff created
     */
    public function onTariffCreated(): void
    {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('New tariff created')
            ->setTextBody('New tariff created')
            ->send();
    }
}