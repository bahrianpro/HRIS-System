<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Ijin */

$this->title = $model->id_ijin;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Ijin'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ijin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_ijin], ['class' => 'btn btn-primary']) ?>
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_ijin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Apakah Anda yakin ingin menghapus item ini??'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_jenis_absen',
            'id_absen',
            'id_pegawai',
            'tgl_absen',
            'alasan:ntext',
            'file_pendukung',
            'status',
        ],
    ]) ?>

</div>
