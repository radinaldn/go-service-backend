<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pemesanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemesanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_teknisi')->textInput() ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <?= $form->field($model, 'keluhan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'jenis_servis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biaya')->textInput() ?>

    <?= $form->field($model, 'proses')->dropDownList([ 'Diproses' => 'Diproses', 'Selesai' => 'Selesai', 'Dibayar' => 'Dibayar', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'kategori_bayar')->dropDownList([ 'Cash' => 'Cash', 'Saldo' => 'Saldo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'foto_sebelum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_sesudah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
