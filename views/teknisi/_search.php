<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeknisiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teknisi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_teknisi') ?>

    <?= $form->field($model, 'nama_toko') ?>

    <?= $form->field($model, 'nama_pemilik') ?>

    <?= $form->field($model, 'nik_pemilik') ?>

    <?= $form->field($model, 'layanan') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'lng') ?>

    <?php // echo $form->field($model, 'siu') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'status_akun') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
