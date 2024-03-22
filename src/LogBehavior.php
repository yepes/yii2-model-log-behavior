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

        if (isset($this->ignoreLogBehavior) && $this->ignoreLogBehavior)
            return;
        $oldAttributes = array_merge($model->oldAttributes, $event->changedAttributes);
        Log::l(
            $oldAttributes,
            $model->attributes,
            $event,
            $model::className(),
            Yii::$app->user->id ?? null,
            $this->getPK($model)
        );
    }

    /**
     * Returns the PK of a given model given that it's formed by only one field.
     * Rows with multiple fields as PKs are not currently supported
     * @param $model
     * @return false|mixed
     */
    private function getPK($model) {
        $pks = $model::getTableSchema()->primaryKey;

        if (count($pks) === 1)
            return $model->{$pks[0]};

        return null;
    }
}
