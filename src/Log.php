<?php

namespace goltratec\log;

use Yii;
use yii\helpers\Json;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property string $old_attributes
 * @property string $new_attributes
 * @property integer $user
 * @property string $event
 * @property string $object
 * @property integer $object_id
 */
class Log extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goltratec_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_attributes', 'new_attributes'], 'string'],
            [['user', 'object_id'], 'integer'],
            [['date'], 'safe'],
            [['event'], 'string', 'max' => 30],
	    [['object'], 'string', 'max' => 65],
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

    static function l(array $oldAttributes, array $newAttributes, $event, $object, $uid = false, $object_id = null) {
		$model = new self;
        $sender = $event->sender;
		if (isset($sender->logIgnoredAttributes) && is_array($sender->logIgnoredAttributes) && count($sender->logIgnoredAttributes) > 0) {
            foreach ($sender->logIgnoredAttributes as $attr) {
                unset($oldAttributes[$attr]);
                unset($newAttributes[$attr]);
            }
        }

		$model->old_attributes = Json::encode($oldAttributes);
		$model->new_attributes = Json::encode($newAttributes);
		$model->event = $event->name;
		$model->object = $object;
		$model->user = $uid;
		$model->date = gmdate('Y-m-d H:i:s');
		$model->object_id = $object_id;
        
		$model->save();
	}
}
