<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PemesananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemesanans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemesanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemesanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pemesanan',
            'nik',
            'id_teknisi',
            'alamat:ntext',
            'lat',
            //'lng',
            //'created_at',
            //'updated_at',
            //'jenis_servis',
            //'biaya',
            //'proses',
            //'kategori_bayar',
            //'foto_sebelum',
            //'foto_sesudah',
            //'ket:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
