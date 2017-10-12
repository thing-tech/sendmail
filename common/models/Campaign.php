<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\Template;

class Campaign extends ActiveRecord
{

    public $template_id;

    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['name', 'from_name', 'from_email', 'reply_to', 'subject'], 'required'],
            ['template', 'string'],
            ['template_id', 'integer']
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(
                parent::attributeLabels(), [
                ]
        );
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->user_id = \Yii::$app->user->id;
            return true;
        }
        return false;
    }

    public function getTemplates()
    {
        $model = Template::find()->where(['user_id' => \Yii::$app->user->id])->all();
        $data[] = 'Choose template';
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
