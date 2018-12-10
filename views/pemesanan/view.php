<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pemesanan */

$this->title = $model->id_pemesanan;
$this->params['breadcrumbs'][] = ['label' => 'Pemesanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pemesanan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_pemesanan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_pemesanan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pemesanan',
            'nik',
            'id_teknisi',
            'alamat:ntext',
            'lat',
            'lng',
            'keluhan:ntext',
            'created_at',
            'updated_at',
            'jenis_servis',
            'biaya',
            'proses',
            'kategori_bayar',
            'foto_sebelum',
            'foto_sesudah',
            'ket:ntext',
        ],
    ]) ?>

</div>
