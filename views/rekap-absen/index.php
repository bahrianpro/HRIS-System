<?php

use yii\helpers\Html;
use dmstr\widgets\Alert;

$this->title = 'Rekap Absen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekap-absen-index">

<div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">calendar_today</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?> </h4>
            </div>
            <div class="card-body">
            <?= Alert::widget(); // echo $this->render('_search', ['model' => $searchModel]);?>;

            <?= $this->render('_search', ['model' => $searchModel]); ?>;

            </div>
        </div>
    </div>
</div>


</div>
