<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    $this->title = '添加规则';
    $this->params['breadcrumbs'][] = ['label' => '规则管理', 'url' => ['/admin/rbac/rules']];
    $this->params['breadcrumbs'][] = $this->title;
    $this->registerCssFile('admin/css/compiled/new-user.css');
?>
    <!-- main container -->
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加规则</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                                <?php
                                if (Yii::$app->session->hasFlash('info')) {
                                    echo Yii::$app->session->getFlash('info');
                                }
                                $form = ActiveForm::begin([
                                    'fieldConfig' => [
                                        'template' => '<div class="span12 field-box">{label}{input}</div>{error}',
                                    ],
                                    'options' => [
                                        'class' => 'new_user_form inline-input',
                                    ],
                                ]);
                                /*echo $form->field($model, 'username')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'useremail')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'userpass')->passwordInput(['class' => 'span9']);
                                echo $form->field($model, 'repass')->passwordInput(['class' => 'span9']);
                                 */
?>
                                <div class="span12 field-box">
                                <?php echo Html::label('类名称', null). Html::textInput('class_name', '', ['class' => 'span9']); ?>
                                </div>
                                
                                <div class="span11 field-box actions">
                                    <?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
                                    <span>OR</span>
                                    <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                                </div>

                                <a href="http://www.yii-china.com/doc/rbac/161.html" target="_blank">先建立Rule类，然后新增。请参考rule文档</a>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
    <!-- end main container -->
