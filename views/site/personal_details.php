<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 25.01.16
 * Time: 15:24
 *
 * @var $model PersonalDetailsForm
 * @var $interests_model UsersInterestsForm
 * @var $interests
 */
use rmrevin\yii\fontawesome\FA;
use dosamigos\datepicker\DatePicker;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\models\UsersInterests;
use app\models\PersonalDetailsForm;
use app\models\UsersInterestsForm;
use app\models\Interests;

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
    'id' => 'personal-details-form',
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
<?php ActiveForm::end();?>
<legend>Hobbies</legend>
<div class="row">
    <div class="col-sm-12">
        <?= Html::ul($interests, ['class' => 'list-inline',
            'item' => function($item, $index) {
                /* @var $item UsersInterests */
                $delete_link = Html::a(FA::icon('times'),
                    ['delete-user-interest', UsersInterests::FIELD_INTEREST_ID => $item->interest_id],
                    ['data-confirm' => Yii::t('yii', 'Are you sure you want to delete "' . $item->interest->title . '" interest?')]);
                return Html::tag('li', '<div class="well well-sm">' . $item->interest->title .'&nbsp&nbsp'. $delete_link. '</div>');
            }
        ])?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-right">
        <?php $form_interest = ActiveForm::begin([
            'id' => 'interests-form',
            'options' => ['class' => 'form-inline'],
            'fieldConfig' => ['template' => "{input}"]
        ]) ?>
            <?= $form_interest->field($interests_model, UsersInterestsForm::FIELD_TITLE)->widget(Typeahead::className(), [
                'dataset' => [
                    [
                    'local' => ArrayHelper::getColumn(Interests::find()->all(), Interests::FIELD_TITLE),
                    'limit' => 10
                    ]
                ],
                'pluginOpti`ons' => ['highlight' => true],
            ]);?>
            <?= Html::submitButton('Add', ['class' => 'btn btn-success', 'form' => 'interests-form']) ?>
        <?php ActiveForm::end();?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6 text-left">
        <?= Html::a('Home', '/site/index', ['class' => 'btn btn-default'])?>
    </div>
    <div class="col-sm-6 text-right">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'form' => 'personal-details-form']) ?>
    </div>
</div>

