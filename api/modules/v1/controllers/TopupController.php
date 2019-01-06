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

    public function actionViewAllByNik($nik){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_topup.*, tb_masyarakat.*, tb_topup.created_at, tb_topup.foto FROM tb_topup INNER JOIN tb_masyarakat
            WHERE tb_topup.nik = tb_masyarakat.nik
            AND tb_topup.nik = '$nik' 
            ORDER BY tb_topup.created_at DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }
}