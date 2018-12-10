<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Masyarakat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masyarakat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'jk')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'agama')->dropDownList([ 'Islam' => 'Islam', 'Kristen' => 'Kristen', 'Katholik' => 'Katholik', 'Budha' => 'Budha', 'Hindu' => 'Hindu', 'Lainnya' => 'Lainnya', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status_kawin')->dropDownList([ 'Kawin' => 'Kawin', 'Belum Kawin' => 'Belum Kawin', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'pekerjaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kewarganegaraan')->dropDownList([ 'WNI' => 'WNI', 'WNA' => 'WNA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saldo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
