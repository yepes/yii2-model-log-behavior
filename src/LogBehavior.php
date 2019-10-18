<?php

namespace goltratec\log;

use Yii;
use yii\base\Behavior;
use \yii\db\ActiveRecord;

class LogBehavior extends Behavior {

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'handleLog',
            ActiveRecord::EVENT_AFTER_UPDATE => 'handleLog',
        ];
    }

    public function handleLog($event) {
        /** @var  $model ActiveRecord*/
        $model = $event->sender;

        Log::l(
            $model->oldAttributes,
            $model->attributes,
            $event,
            $model::className(),
            Yii::$app->user->id ?? null
        );
    }
}
