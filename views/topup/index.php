<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TopupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Topups';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Breadcomb area Start-->
<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-windows"></i>
									</div>
									<div class="breadcomb-ctn">
                                    <h2><?= Html::encode($this->title) ?></h2>
										<p>Data Master <span class="bread-ntd"><?= Html::encode($this->title) ?></span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            
                            <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p>
                        </div>

<div class="topup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Topup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- Standard Alert -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <?= Yii::$app->session->getFlash('success') ?> <a href="#" class="alert-link"></a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('failed')): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <?= Yii::$app->session->getFlash('failed') ?> <a href="#" class="alert-link"></a>
            </div>
        </div>
    </div>
    <?php endif; ?>
<!-- end of standard alert -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_topup',
            'nik',
            'nominal',
            'created_at',
            // 'updated_at',
            //'foto',
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Proses',
                'value'=>function($data){
                    if($data->proses == "Diterima"){
                        return Html::decode(Html::decode('<a title="Lihat topup" href="'.Url::to(['topup/view?id=']).$data->id_topup.'"><span class="label label-success"><i class="ti-check"></i> '.$data->proses.'</span></a>'));
                    } else if ($data->proses == 'Diproses'){
                        return Html::decode(Html::decode('<a title="Lihat topup" href="'.Url::to(['topup/view?id=']).$data->id_topup.'"><span class="label label-warning"><i class="ti-check"></i> '.$data->proses.'</span></a>'));
                    } else if ($data->proses == "Ditolak"){
                        return Html::decode(Html::decode('<a title="Lihat topup" href="'.Url::to(['topup/view?id=']).$data->id_topup.'"><span class="label label-danger"><i class="ti-check"></i> '.$data->proses.'</span></a>'));
                    }
                },
            ],
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Aksi',
                'value'=>function($data){
                    return Html::decode(Html::decode('
                    <a title="Terima Topup" href="'.Url::to(['topup/terima?id=']).$data->id_topup.'"><span class=" btn btn-success btn-xs"><i class="fa fa-check"></i> </span></a> 
                    <a title="Tolak Topup" href="'.Url::to(['topup/tolak?id=']).$data->id_topup.'"><span class=" btn btn-danger btn-xs"><i class="fa fa-times"></i> </span></a> '));
                },
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

