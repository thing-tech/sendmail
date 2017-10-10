<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[Content]].
 *
 * @see content
 */
class TermQuery extends \yii\db\ActiveQuery {

    public function parentID($parent) {
        return $this->andWhere(['category.parent_id' => $parent]);
    }

    /**
     * @inheritdoc
     * @return content[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return content|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
