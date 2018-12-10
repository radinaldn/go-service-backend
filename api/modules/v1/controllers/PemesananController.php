<?php
namespace app\api\modules\v1\controllers;

use Yii;
use app\models\Pemesanan;
use yii\rest\Controller;
use yii\web\Response;

class PemesananController extends Controller{
    public function actionAdd(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $pemesanan = new Pemesanan();
            $pemesanan->nik = $data['nik'];
            $pemesanan->id_teknisi = $data['id_teknisi'];
            $pemesanan->alamat = $data['alamat'];
            $pemesanan->lat = $data['lat'];
            $pemesanan->lng = $data['lng'];
            $pemesanan->jenis_servis = $data['jenis_servis'];
            $pemesanan->biaya = 0;
            $pemesanan->kategori_bayar = $data['kategori_bayar'];
            $pemesanan->foto_sebelum = $data['foto_sebelum'];
            $pemesanan->keluhan = $data['keluhan'];

            if ($pemesanan->save(false)){
                $response['code'] = 200;
                $response['message'] = "Pesanan berhasil dikirim!";
                $response['data'] = $pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Pesanan gagal dikirim!";
                $response['data'] = null;
            }
            
        }
        
        return $response;
    }

    public function actionUpdate(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_pemesanan = $data['id_pemesanan'];

            $pemesanan = Pemesanan::find()
                        ->where(['id_pemesanan' => $id_pemesanan])
                        ->one();

            $pemesanan->nik = $data['nik'];
            $pemesanan->id_teknisi = $data['id_teknisi'];
            $pemesanan->alamat = $data['alamat'];
            $pemesanan->lat = $data['lat'];
            $pemesanan->lng = $data['lng'];
            $pemesanan->jenis_servis = $data['jenis_servis'];
            $pemesanan->biaya = 0;
            $pemesanan->kategori_bayar = $data['kategori_bayar'];
            $pemesanan->foto_sebelum = $data['foto_sebelum'];
            $pemesanan->keluhan = $data['keluhan'];

            if ($pemesanan->update(false)){
                $response['code'] = 200;
                $response['message'] = "Pesanan berhasil diupdate!";
                $response['data'] = $pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Pesanan gagal diupdate!";
                $response['data'] = null;
            }
            
        }
        
        return $response;
    }

    public function actionDelete(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $id_pemesanan = $data['id_pemesanan'];

            $pemesanan = Pemesanan::find()
                        ->where(['id_pemesanan' => $id_pemesanan])
                        ->one();
            
            if ($pemesanan->delete()){
                $response['code'] = 200;
                $response['message'] = "Pesanan berhasil dihapus!";
                $response['data'] = $pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Pesanan gagal dihapus!";
                $response['data'] = null;
            }
        }

        return $response;
    }

    public function actionView($id_pemesanan){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $pemesanan = Pemesanan::find()
                        ->where(['id_pemesanan' => $id_pemesanan])
                        ->one();

            $response['master'] = $pemesanan;
        }

        return $response;
    }

    public function actionViewAllByNik($nik){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $pemesanan = Pemesanan::find()
                        ->where(['nik' => $nik])
                        ->orderBy(['created_at' => SORT_DESC])
                        ->all();

            $response['master'] = $pemesanan;
        }

        return $response;
    }

    public function actionViewAllByIdTeknisi($id_teknisi){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $pemesanan = Pemesanan::find()
                        ->where(['id_teknisi' => $id_teknisi])
                        ->orderBy(['created_at' => SORT_DESC])
                        ->all();

            $response['master'] = $pemesanan;
        }

        return $response;
    }

    public function actionViewAllByNikAndProses($nik, $proses){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $pemesanan = Pemesanan::find()
                        ->where(['nik' => $nik])
                        ->andWhere(['proses' => $proses])
                        ->orderBy(['created_at' => SORT_DESC])
                        ->all();

            $response['master'] = $pemesanan;
        }

        return $response;
    }

    public function actionViewAllByIdTeknisiAndProses($id_teknisi, $proses){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $pemesanan = Pemesanan::find()
                        ->where(['id_teknisi' => $id_teknisi])
                        ->andWhere(['proses' => $proses])
                        ->all();

            $response['master'] = $pemesanan;
        }

        return $response;
    }

    public function actionUpdateProses(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $id_pemesanan = $data['id_pemesanan'];
            $proses = $data['proses']; // [Diproses, Dikerjakan, Selesai, Dibayar]

            $pemesanan = Pemesanan::find()
                        ->where(['id_pemesanan' => $id_pemesanan])
                        ->one();

            $pemesanan->proses = $proses;
            
            if($pemesanan->update()){
                $response['code'] = 200;
                $response['message'] = "Proses berhasil diupdate menjadi ".$proses;
                $response['data'] = $pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Proses gagal diupdate menjadi ".$proses;
                $response['data'] = $pemesanan;
            }
        }

        return $response;
    }

    public function actionUpdateByTeknisi(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $id_pemesanan = $data['id_pemesanan'];

            $pemesanan = Pemesanan::find()
                        ->where(['id_pemesanan' => $id_pemesanan])
                        ->one();

            $pemesanan->ket = $data['ket'];
            $pemesanan->biaya = $data['biaya'];
            $pemesanan->proses = $data['proses']; // [Diproses, Dikerjakan, Selesai, Dibayar]
            $pemesanan->foto_sesudah = $data['foto_sesudah'];
            
            
            if($pemesanan->update()){
                $response['code'] = 200;
                $response['message'] = "Proses update berhasil!";
                $response['data'] = $pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Proses update gagal!";
                $response['data'] = $pemesanan;
            }
        }

        return $response;
    }
}