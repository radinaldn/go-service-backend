<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teknisi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teknisi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_pemilik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'layanan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <?= $form->field($model, 'siu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_akun')->dropDownList([ 'Aktif' => 'Aktif', 'Non Aktif' => 'Non Aktif', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
