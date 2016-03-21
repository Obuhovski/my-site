<?php

namespace obuhovski\comments\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $entity
 * @property integer $entity_id
 * @property string $content
 * @property integer $parent_id
 * @property integer $level
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 */
class Comment extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity' => 'Entity',
            'content' => 'Content',
            'parent_id' => 'Parent ID',
            'level' => 'Level',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function rules()
    {
        return [
            ['content', 'safe'],
            ['status', 'in', 'range' => [0,1] ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildrens()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \obuhovski\comments\models\queries\CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \obuhovski\comments\models\queries\CommentQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->ip = Yii::$app->request->getUserIP();
        }

        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        if (isset($this->created_by)) {
            $this->username = $this->createdBy->username;
            $this->email = $this->createdBy->email;
        }

        return parent::afterFind();
    }

}
