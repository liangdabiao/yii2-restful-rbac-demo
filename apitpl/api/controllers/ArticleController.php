<?php
namespace api\controllers;
 
use yii\data\ActiveDataProvider;
use common\models\Article; 
use common\models\Adminuser; 
use api\controllers\CommonController;


class ArticleController extends CommonController
{
    public $modelClass = 'common\models\Article';
    
   
    public  function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    
    public function actionIndex()
    {
        $modelClass = $this->modelClass;
        return new ActiveDataProvider(
                [
                    'query'=>$modelClass::find()->asArray(),
                    'pagination'=>['pageSize'=>5],
                ]
            );
    }
    
    public function actionSearch() { 
        return Article::find()->where(['like','title',$_POST['keyword']])->all();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}