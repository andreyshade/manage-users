<?php

use yii\helpers\Html;
use app\models\Users;
use yii\widgets\ListView;


/**
 * @var yii\web\View $this
 * @var Users $user
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'People\'s Interests Community home page';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to People's Interests Community!</h1>

        <p class="lead">Find your feature friend by interests.</p>

        <p> <?php if(Yii::$app->user->isGuest):?>
                <?= Html::a('Get start!', 'site/login', ['class' => 'btn btn-lg btn-success']) ?>
            <?php else:?>
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">You</h3>
                        </div>
                        <div class="panel-body">
                            <?= ($user->getFullName() ? Html::tag('h4', Html::encode($user->getFullName())) : '') ?>
                            <?= ($user->date_of_birth) ? Html::tag('div', 'Birthday: ' . DateTime::createFromFormat('Y-m-d', $user->date_of_birth)->format('d/m/Y')) : ''?>
                            <?= $user->getInterestsList()?>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </>
    </div>

    <div class="body-content">
        <legend>Latest updates</legend>
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'showOnEmpty' => false,
                'emptyText' => '<div class="col-sm-12">No users available</div>',
                'itemView' => '_user_details',
                'layout' => '{items}'
            ])?>
        </div>
    </div>
</div>
