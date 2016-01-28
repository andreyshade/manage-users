<?php
/**
 * Created by PhpStorm.
 * User: andreyshade
 * Date: 28.01.16
 * Time: 17:30
 *
 * @var \app\models\Users $model
 */
use yii\helpers\Html;
?>
<div class="col-sm-3 text-center">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $model->login?></h3>
        </div>
        <div class="panel-body">
            <?= ($model->getFullName() ? Html::tag('h4', Html::encode($model->getFullName())) : '')?>
            <?= ($model->date_of_birth) ? Html::tag('div', 'Birthday: ' . DateTime::createFromFormat('Y-m-d', $model->date_of_birth)->format('d/m/Y')) : ''?>
            <?= $model->getInterestsList()?>
        </div>
    </div>
</div>

