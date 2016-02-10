<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 25.01.16
 * Time: 15:24
 *
 * @var $model PersonalDetailsForm
 */
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\models\PersonalDetailsForm;

$this->title = 'Personal details';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<h1><?= $this->title?></h1>
<?php $form = ActiveForm::begin([
    'id' => 'personal_details_form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-sm-3\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
    ],
])?>
    <legend>Your personal details</legend>
    <?= $form->field($model, PersonalDetailsForm::FIELD_LOGIN)?>
    <?= $form->field($model, PersonalDetailsForm::FIELD_FIRST_NAME)?>
    <?= $form->field($model, PersonalDetailsForm::FIELD_LAST_NAME)?>
    <?= $form->field($model, PersonalDetailsForm::FIELD_DATE_OF_BIRTH)->widget(DatePicker::className(),[
        'clientOptions' => [
        'autoclose' => true,
        'format' => 'dd/mm/yyyy'
    ]])?>
    <legend>Hobbies</legend>
    <div class="row">
        <div class="col-sm-12 text-left">
            <?php $form_interest = ActiveForm::begin([
                'options' => ['class' => 'form-inline'],
                'fieldConfig' => ['template' => "{input}"]
            ]) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 text-left">
            <?= Html::a('Home', '/site/index', ['class' => 'btn btn-default'])?>
        </div>
        <div class="col-sm-6 text-right">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end();?>
