<?php
namespace api\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use common\models\Article; 
use common\models\Adminuser; 

use yii\helpers\ArrayHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
//use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;


class ArticleController extends ActiveController
{
    public $modelClass = 'common\models\Article';
    
     

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                //HttpHeaderAuth::class,
                QueryParamAuth::class
            ]
        ]; 
 
        return $behaviors;
    }
   
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