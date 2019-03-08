<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property string $old_attributes
 * @property string $new_attributes
 * @property integer $user
 * @property string $event
 * @property string $object
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_attributes', 'new_attributes'], 'string'],
            [['user'], 'integer'],
            [['date'], 'safe'],
            [['event', 'object'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_attributes' => 'Old Attributes',
            'new_attributes' => 'New Attributes',
            'user' => 'User',
            'event' => 'Event',
            'object' => 'Object',
        ];
    }

    static function l(array $oldAttributes, array $newAttributes, string $event, $object, $uid = false) {
		$model = new self;
		$model->old_attributes = Json::encode($oldAttributes);
		$model->new_attributes = Json::encode($newAttributes);
		$model->event = $event;
		$model->object = $object;
		$model->user = $uid;
        $model->date = new \yii\db\Expression('NOW()');
		$model->save();
	}
}
