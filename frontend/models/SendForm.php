<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\RecipientList;

/**
 * Signup form
 */
class SendForm extends Model
{

    public $list;
    public $name;
    public $subject;
    public $from_name;
    public $from_email;
    public $reply_to;
    public $template;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['list'], 'required'],
            [['name', 'from_name', 'from_email', 'reply_to', 'subject'], 'required'],
            ['template','string']
        ];
    }

    public function lists()
    {
        $model = RecipientList::find()->where(['user_id' => \Yii::$app->user->id])->all();
        if ($model)
        {
            foreach ($model as $value)
            {
                $data[$value->id] = $value->name;
            }
        }
        return $data;
    }

}
