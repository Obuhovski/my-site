<?php

namespace obuhovski\blog\frontend\controllers;

use Yii;
use obuhovski\blog\models\Post;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $postSearchForm = new DynamicModel(['search']);
        $postSearchForm->addRule('search','string',['length'=>[3,255],'tooShort'=>'Поиск должен содержать минимум 3 символа.']);
        $query = Post::find()
            ->distinct()
            ->joinWith('categories')
            ->where(['post.status' => 1])
            ->orderBy('created DESC');

        $request = Yii::$app->request;
        $query->filterWhere(['category_id'=>$request->getQueryParam('category')]);

        if ($postSearchForm->load($request->queryParams,'') && $postSearchForm->validate()) {
            $query->andFilterWhere([
                'OR',
                ['LIKE','title',$request->getQueryParam('search')],
                ['LIKE','anotation',$request->getQueryParam('search')],
                ['LIKE','text',$request->getQueryParam('search')]
            ]);
        }

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 3
        ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'postSearchForm' => $postSearchForm
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => $this->findModel($slug),
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Post::findOne(['slug'=>$slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
