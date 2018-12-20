<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
            <div class="nk-form">
            <img style="height: 150px" src="<?= Yii::$app->homeUrl ?>custom/img/logo/logo.png"  alt="" />
            <br>
            <br>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                    <div class="nk-int-st">
                        <!-- <input type="text" class="form-control" placeholder="Username"> -->
                        <?= $form
                ->field($model, 'username')
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                    </div>
                </div>
                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                    <div class="nk-int-st">
                        <!-- <input type="password" class="form-control" placeholder="Password"> -->
                        <?= $form
                ->field($model, 'password')
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                    </div>
                </div>
                <div class="fm-checkbox">
                    <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
                    <br>
                    <?= Html::submitButton('LOGIN', ['class'=>['btn btn-primary btn-bordred col-xs-12'], 'name' => 'login-button']) ?>
                    <div class="form-group">
                
            </div>
                </div>
                <a href="#l-register" data-ma-action="nk-login-switch" data-ma-block="#" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></a>
            </div>

            <div class="nk-navigation nk-lg-ic">
                
                <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

        
        
    