<?php
use kartik\select2\Select2;
use app\models\Tunjangan;
use yii\helpers\ArrayHelper;

$data = ArrayHelper::map(Tunjangan::find()->select(['id_tunjangan','nama_tunjangan'=>"concat(kode_tunjangan,' - ',nama_tunjangan)"])
->asArray()->all(), 'id_tunjangan', 'nama_tunjangan');

?>
<td>
<?= $form->field($model, "[$key]id_tunjangan")->widget(Select2::classname(), [
    'data' => $data,
    'options' => [
        'placeholder' => 'Pilih Tunjangan ...',
    ],
    'pluginOptions' => [
        'allowClear' => true,
    ],
])->label(false); ?>

</td>
<td>
<?= $form->field($model, "[$key]jumlah")->textInput()->label(false);
?>

</td>


    <td>

    <a data-action="delete" id='delete3'><span class="glyphicon glyphicon-trash">
</td>
