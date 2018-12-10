<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeknisiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teknisis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teknisi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teknisi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_teknisi',
            'nama_toko',
            'nama_pemilik',
            'nik_pemilik',
            'layanan:ntext',
            //'alamat:ntext',
            //'no_hp',
            //'lat',
            //'lng',
            //'siu',
            //'foto',
            //'status_akun',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
