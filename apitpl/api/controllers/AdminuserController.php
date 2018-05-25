<?php
namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use api\models\ApiLoginForm;


class AdminuserController extends ActiveController
{
    public $modelClass = 'common\models\Adminuser';
    
    
    /*public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                HttpHeaderAuth::class,
                QueryParamAuth::class
            ]
        ];

        return $behaviors;
    }*/

    public function actionLogin()
    {
        $model = new ApiLoginForm();
        
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        
//         $model->username = $_POST['username'];
//         $model->password = $_POST['password'];
        
        if ($model->login()) {
            return ['access_token' => $model->login()];
        }
        else {
            $model->validate();
            return $model;
        }
        
    }
    
    
}