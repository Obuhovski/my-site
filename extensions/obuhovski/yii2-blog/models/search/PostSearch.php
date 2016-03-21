<?php

namespace obuhovski\blog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use obuhovski\blog\models\Post;

/**
 * PostSearch represents the model behind the search form about `obuhovski\blog\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'views', 'status'], 'integer'],
            [['created', 'updated', 'title', 'slug', 'anotation', 'text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->orderBy('id DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'views' => $this->views,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'anotation', $this->anotation])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
