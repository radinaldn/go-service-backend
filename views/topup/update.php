<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Topup */

$this->title = 'Update Topup: ' . $model->id_topup;
$this->params['breadcrumbs'][] = ['label' => 'Topups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_topup, 'url' => ['view', 'id' => $model->id_topup]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="topup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
