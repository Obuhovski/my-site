<?php

namespace obuhovski\comments\models\queries;
use obuhovski\comments\models\User;

/**
 * This is the ActiveQuery class for [[\obuhovski\comments\models\Comment]].
 *
 * @see \obuhovski\comments\models\Comment
 */
class CommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \obuhovski\comments\models\Comment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \obuhovski\comments\models\Comment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return \obuhovski\comments\models\Comment[]|array
     */
    public function tree($db = null)
    {
        $all = $this->asArray()->all();
        return $this->buildTree($all);
    }

    function buildTree(array &$elements, $parentId = null, $level = 0) {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['childrens'] = $children;
                }
                if (isset($element['created_by'])) {
                    $user = User::findOne($element['created_by']);
                    $element['username'] = $user->username;
                }
                $element['avatar'] = isset($user->profile->avatar)?$user->profile->avatar:'http://www.gravatar.com/avatar/';
                $branch[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }
}
