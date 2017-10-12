<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\User;

/**
 * Location model
 *
 * @property string $name
 * @property string $sectors
 */
class Template extends ActiveRecord {

    public static function tableName() {
        return 'template';
    }

    public function rules() {
        return [
            [['name'], 'required'],
            [['html'], 'string']
        ];
    }

    public function attributeLabels() {
        return [
        ];
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ]);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->user_id = \Yii::$app->user->id;
            return true;
        }
        return false;
    }

}
