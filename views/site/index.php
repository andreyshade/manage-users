<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'People\'s Interests Community home page';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to People's Interests Community!</h1>

        <p class="lead">Find your feature friend by interests.</p>

        <p>
            <?= Html::a('Get start!', 'site/login', ['class' => 'btn btn-lg btn-success']) ?>
        </p>
    </div>

    <div class="body-content">
        <legend>Latest updates</legend>
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User1</h3>
                    </div>
                    <div class="panel-body">
                        Interests
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User1</h3>
                    </div>
                    <div class="panel-body">
                        Interests
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User1</h3>
                    </div>
                    <div class="panel-body">
                        Interests
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User1</h3>
                    </div>
                    <div class="panel-body">
                        Interests
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
