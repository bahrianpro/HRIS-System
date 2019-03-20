<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Golongan */

$this->title = Yii::t('app', 'Golongan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Golongan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-create">

  <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_seat</i>
                </div>
                <h4 class="card-title">Golongan Baru</h4>
            </div>
            <div class="card-body ">

                <?=
                $this->render('_form', [
                    'model' => $model,
                ]);
                ?>

            </div>
        </div>
    </div>
</div>
