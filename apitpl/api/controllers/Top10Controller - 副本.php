<?php
namespace api\controllers;

use Yii;
use yii\rest\Controller;
use common\models\Article;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
//use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;

class Top10Controller extends Controller
{
    /*public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        parent::beforeAction($action);

        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            // End it, otherwise a 401 will be shown.
            Yii::$app->end();
        }

        return true;
    }*/

    //多种方式验证token
    public function behaviors()
    {
        


        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [ 
            'class' => \yii\filters\Cors::className(), 
            'cors' => [ 
                // restrict access to 
                'Access-Control-Request-Method' => ['*'], 
                // Allow only POST and PUT methods 
                'Access-Control-Request-Headers' => ['*'], 
                // Allow only headers 'X-Wsse' 
                'Access-Control-Allow-Credentials' => true, 
                // Allow OPTIONS caching 
                'Access-Control-Max-Age' => 3600, 
                // Allow the X-Pagination-Current-Page header to be exposed to the browser. 
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'], 
            ], 
        ]; 

        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') { 
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                //HttpHeaderAuth::class,
                QueryParamAuth::class
            ]
        ]; 

        //$a = Yii::$app->request->headers;
        //print_r($a);exit;
        }

        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actionIndex()
    {
        $top10 = (new Query())
            ->from('article')
            ->select(['created_by','Count(id) as creatercount'])
            ->groupBy(['created_by'])
            ->orderBy('creatercount DESC')
            ->limit(10)
            ->all();
        
        return $top10;
    }
 
}