<?php

namespace obuhovski\blog\models;

use DateTime;
use mongosoft\file\UploadBehavior;
use mongosoft\file\UploadImageBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $created
 * @property string $updated
 * @property string $title
 * @property string $slug
 * @property string $anotation
 * @property string $text
 * @property integer $status
 *
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title',  'anotation', 'text', 'status', 'category_ids'], 'required'],
            [['author_id', 'status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['anotation', 'text'], 'string'],
            [['category_ids'], 'each', 'rule' => ['integer']],
            [['title', 'slug'], 'string', 'max' => 255],
            ['image', 'file', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yii::$app->getUser()->identityClass, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'created' => 'Создан',
            'updated' => 'Изменен',
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'anotation' => 'Анотация',
            'text' => 'Текст',
            'status' => 'Статус',
            'category_ids' => 'Категории',
            'image' => 'Изображение',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'image',
                'scenarios' => ['default'],
                'path' => '@webroot/uploads/posts/{id}',
                'url' => '@web/uploads/posts/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 200, 'quality' => 90],
                ],
            ],
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('posts_categories', ['post_id' => 'id']);
    }


    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->author_id = Yii::$app->user->id;
            $this->created = (new DateTime())->format('Y-m-d H:i:s');;
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->created = \DateTime::createFromFormat('Y-m-d H:i:s',$this->created)->format('d.m.Y');
        return parent::afterFind();
    }
}
