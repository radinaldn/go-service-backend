<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teknisi */

$this->title = $model->id_teknisi;
$this->params['breadcrumbs'][] = ['label' => 'Teknisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teknisi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_teknisi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_teknisi], [
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
            'id_teknisi',
            'nama_toko',
            'nama_pemilik',
            'nik_pemilik',
            'layanan:ntext',
            'alamat:ntext',
            'no_hp',
            'lat',
            'lng',
            'siu',
            'foto',
            'status_akun',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
