<?php
namespace app\api\modules\v1\controllers;

use Yii;
use app\models\Topup;
use yii\rest\Controller;
use yii\web\Response;

class TopupController extends Controller{
    public function actionAdd(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $topup = new Topup();
            $topup->nik = $data['nik'];
            $topup->nominal = $data['nominal'];
            $topup->foto = $data['foto'];

            if ($topup->save()){
                $response['code'] = 200;
                $response['message'] = "Topup senilai ".$topup->nominal." berhasil!\nHarap menunggu administrator memproses permintaan anda.";
                $response['data'] = $topup;
            } else {
                $response['code'] = 500;
                $response['message'] = "Topup senilai ".$topup->nominal." gagal!\nHarap coba lagi.";
                $response['data'] = $topup;
            }
        }

        return $response;
    }
}