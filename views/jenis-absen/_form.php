<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JenisAbsen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-absen-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'nama_jenis_absen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_hadir')->dropDownList([ 'Hadir' => 'Hadir', 'Tidak Hadir' => 'Tidak Hadir', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
