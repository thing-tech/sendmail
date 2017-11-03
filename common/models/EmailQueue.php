<?php

namespace common\models;

/**
 * This is the model class for table "{{email_queue}}".
 *
 * The followings are the available columns in table '{{email_queue}}':
 * @property integer $id
 * @property string $from_name
 * @property string $from_email
 * @property string $to
 * @property string $subject
 * @property string $message
 */
class EmailQueue extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'email_queue';
    }

    public function rules()
    {
        return [
            [['from_name', 'from_email', 'to', 'subject', 'message'], 'string'],
//            [['date_published', 'date_sent', 'success', 'attempts', 'max_attempts'], 'integer']
        ];
    }


}
