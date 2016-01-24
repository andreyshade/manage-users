<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
/* @var $registration_model \app\models\RegistrationForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\RegistrationForm;
use app\models\LoginForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-sm-3\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, LoginForm::FIELD_LOGIN)->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-sm-offset-1 col-sm-3\">{input} {label}</div>\n<div class=\"col-sm-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'form' => 'login-form']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    <hr>
    <h1>Register</h1>
    <p>Please fill out the following fields to register:</p>
    <?php $registration_form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-sm-3\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-sm-1 control-label'],
        ],
    ]); ?>

        <?= $registration_form->field($registration_model, RegistrationForm::FIELD_LOGIN)?>

        <?= $registration_form->field($registration_model, RegistrationForm::FIELD_PASSWORD)->passwordInput()?>

        <?= $registration_form->field($registration_model, RegistrationForm::FIELD_PASSWORD_CONFIRM)->passwordInput()?>

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-11">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'form' => 'register-form']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
