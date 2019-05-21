<?php

namespace yepes\log;

use Yii;
use yii\base\Behavior;
use \yii\db\ActiveRecord;

class LogBehavior extends Behavior {

	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_INSERT => 'handleLog',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'handleLog',
			ActiveRecord::EVENT_BEFORE_DELETE => 'handleLog',
		];
	}

	public function handleLog(yii\base\ModelEvent $event) {
		/** @var  $model ActiveRecord*/
		$model = $event->sender;
		if ($event->isValid) {
			Log::l(
				$model->oldAttributes,
				$model->attributes,
				$event->name,
				$model::className(),
				Yii::$app->user->id ?? null
			);
		}
	}
}
