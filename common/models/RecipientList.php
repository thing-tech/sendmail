<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\User;
use yii\web\UploadedFile;
use common\models\Subscriber;

/**
 * Location model
 *
 * @property string $name
 * @property string $sectors
 */
class RecipientList extends ActiveRecord
{

    public $file;

    public static function tableName()
    {
        return 'list';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['file', 'file']
        ];
    }

    public function attributeLabels()
    {
        return [
        ];
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

    public function afterSave($insert, $attributes)
    {
        parent::afterSave($insert, $attributes);
        $file = UploadedFile::getInstance($this, 'file');
        if (!empty($file))
        {
            $name = time() . '.' . $file->extension;
            $file->saveAs(\Yii::getAlias("@frontend/web/uploads/") . $name);
            $objPHPExcel = \PHPExcel_IOFactory::load(\Yii::getAlias("@frontend/web/uploads/") . $name);
            $highestRow = $objPHPExcel->getActiveSheet(0)->getHighestRow();
            for ($row = 2; $row <= $highestRow; ++$row)
            {
                $name = trim($objPHPExcel->getActiveSheet(0)->getCellByColumnAndRow(0, $row)->getValue());
                $email = trim($objPHPExcel->getActiveSheet(0)->getCellByColumnAndRow(1, $row)->getValue());
                if (!$subscriber = Subscriber::findOne(['email' => $email, 'list_id' => $this->id]))
                {
                    $subscriber = new Subscriber();
                    $subscriber->name = $name;
                    $subscriber->email = $email;
                    $subscriber->list_id = $this->id;
                    $subscriber->save();
                }
            }
            \Yii::$app->db->createCommand()
                    ->update('list', ['count' => Subscriber::find()->where(['list_id' => $this->id])->count()], 'id = ' . $this->id)
                    ->execute();
        }
    }

    public function beforeDelete()
    {
        Subscriber::deleteAll(['list_id' => $this->id]);
        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
