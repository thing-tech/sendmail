<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[Content]].
 *
 * @see content
 */
class PostQuery extends \yii\db\ActiveQuery
{

    public function published()
    {
        return $this->andWhere(['post.status' => \common\models\Post::PUBLIC_ACTIVE]);
    }

    /**
     * @inheritdoc
     * @return content[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return content|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
