<?php

namespace app\controllers;

use app\models\events\TariffEvent;
use app\models\Tariff;
use Yii;
use yii\rest\Controller;
use yii\rest\CreateAction;
use yii\web\ServerErrorHttpException;

/**
 * Class TariffController
 * @package app\controllers
 */
class TariffController extends Controller
{
    /**
     * @return mixed
     * @throws ServerErrorHttpException
     */
    public function actionCreate(): mixed
    {
        $action = new CreateAction($this->action->id, $this, [
            'modelClass' => Tariff::class,
            'scenario' => Tariff::SCENARIO_FILTERING,
        ]);

        /** @var Tariff $model */
        $model = $action->run();

        if (!$model->hasErrors()) {
            $model->trigger(Tariff::EVENT_AFTER_TARIFF_CREATED, new TariffEvent());
            Yii::info("A new tariff {$model->name} was created", 'app\models\Tariff');
        }

        return $model;
    }
}