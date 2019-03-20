<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HitungTunjangan */

$this->title = Yii::t('app', 'Hitung Tunjangan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Hitung Tunjangan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">money</i>
                </div>
                <h4 class="card-title">Hitung Tunjangan Baru</h4>
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
