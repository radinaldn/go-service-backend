<?php
namespace app\api\modules\v1\controllers;

use Yii;
use app\models\Pemesanan;
use app\models\Masyarakat;
use app\models\Teknisi;
use yii\rest\Controller;
use yii\web\Response;
use Pusher\PushNotifications\PushNotifications;

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

                // send push notif to teknisi
                $title = "Pesanan Diproses";
                $body = "Berhasil menerima pesanan ";
                PemesananController::sendPushNotifToTeknisi($pemesanan->id_teknisi, $title, $body);

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
            $sql = "SELECT tb_pemesanan.*, tb_teknisi.*, tb_pemesanan.created_at, tb_pemesanan.updated_at FROM tb_pemesanan INNER JOIN tb_teknisi
            WHERE tb_pemesanan.id_teknisi = tb_teknisi.id_teknisi
            AND tb_pemesanan.id_pemesanan = '$id_pemesanan' 
            ORDER BY tb_pemesanan.created_at DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
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
            $sql = "SELECT tb_pemesanan.*, tb_teknisi.*, tb_pemesanan.created_at, tb_pemesanan.updated_at FROM tb_pemesanan INNER JOIN tb_teknisi
            WHERE tb_pemesanan.id_teknisi = tb_teknisi.id_teknisi
            AND tb_pemesanan.nik = '$nik' 
            AND tb_pemesanan.proses = '$proses'
            ORDER BY tb_pemesanan.created_at DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    

    public function actionViewAllByIdTeknisiAndProses($id_teknisi, $proses){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_pemesanan.*, tb_masyarakat.*, tb_pemesanan.created_at, tb_pemesanan.updated_at FROM tb_pemesanan INNER JOIN tb_masyarakat
            WHERE tb_pemesanan.nik = tb_masyarakat.nik
            AND tb_pemesanan.id_teknisi = '$id_teknisi' 
            AND tb_pemesanan.proses = '$proses'
            ORDER BY tb_pemesanan.created_at DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    public function actionViewByTeknisi($id_pemesanan){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_pemesanan.*, tb_masyarakat.*, tb_pemesanan.created_at, tb_pemesanan.updated_at FROM tb_pemesanan INNER JOIN tb_masyarakat
            WHERE tb_pemesanan.nik = tb_masyarakat.nik
            AND tb_pemesanan.id_pemesanan = '$id_pemesanan' 
            ORDER BY tb_pemesanan.created_at DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
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

    public function actionBayarDenganSaldo(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $nik = $data['nik'];
            $id_pemesanan = $data['id_pemesanan'];

            // temukan data pemesanan
            $pemesanan = Pemesanan::find()->where(['id_pemesanan'=>$id_pemesanan])->one();

            if (isset($pemesanan)){
                // cek saldo masyarakat
                $masyarakat = Masyarakat::find()->where(['nik'=>$nik])->one();
                if (isset($masyarakat)){
                    if ($masyarakat->saldo >= $pemesanan->biaya){
                        // kurangi saldo masyarakat sesuai biaya, tambah saldo teknisi dan update status pemesanan = Dibayar            
                        $masyarakat->saldo -= $pemesanan->biaya;
                        $teknisi = Teknisi::find()->where(['id_teknisi'=>$pemesanan->id_teknisi])->one();
                    
                        if (isset($teknisi)){
                            $teknisi->saldo+=$pemesanan->biaya;

                            $pemesanan->proses = "Dibayar";

                            if ($masyarakat->update(false) && $teknisi->update(false) && $pemesanan->update(false)){

                                // send push notif to teknisi
                                $title = "Pesanan Dibayar";
                                $body = "Anda menerima Rp".$pemesanan->biaya;
                                PemesananController::sendPushNotifToTeknisi($pemesanan->id_teknisi, $title, $body);

                                // proses bayar dengan saldo sukses
                                $response['code'] = 200;
                                $response['message'] = "Proses bayar dengan saldo berhasil!";
                                $response['masyarakat'] = $masyarakat;
                                $response['teknisi'] = $teknisi;
                                $response['pemesanan'] = $pemesanan;

                            } else {

                                // proses bayar dengan saldo gagal
                                $response['code'] = 500;
                                $response['message'] = "Proses bayar dengan saldo gagal!";
                                $response['masyarakat'] = $masyarakat;
                                $response['teknisi'] = $teknisi;
                                $response['pemesanan'] = $pemesanan;
                            }
                        } else {
                            $response['code'] = 500;
                            $response['message'] = "Data teknisi tidak ditemukan";
                        }

                    } else {
                        // saldo tak cukup
                        $response['code'] = 500;
                                $response['message'] = "Saldo anda tidak mencukupi!";
                                // $response['masyarakat'] = $masyarakat;
                                // $response['teknisi'] = $teknisi;
                                // $response['pemesanan'] = $pemesanan;
                    }
                } else {
                    $response['code'] = 500;
                    $response['message'] = "Data masyarakat tidak ditemukan";
                }
            } else {
                $response['code'] = 500;
                $response['message'] = "Data pemesanan tidak ditemukan";
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

                // send push notif to masyarakat
                $title = "Pesanan ".$pemesanan->proses;
                $body = "Harap bayar Rp".$pemesanan->biaya." (".$pemesanan->kategori_bayar.")";
                PemesananController::sendPushNotifToMasyarakat($pemesanan->nik, $title, $body);


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

    public function actionViewDashboardDataByIdTeknisi($id_teknisi){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet){
            $diproses = Pemesanan::find()->where(['id_teknisi' => $id_teknisi])
                                        ->andWhere(['proses' => 'Diproses'])
                                        ->count();

            $selesai = Pemesanan::find()->where(['id_teknisi' => $id_teknisi])
                                        ->andWhere(['proses' => 'Selesai'])
                                        ->count();
        
            $dibayar = Pemesanan::find()->where(['id_teknisi' => $id_teknisi])
                                        ->andWhere(['proses' => 'Dibayar'])
                                        ->count();

            $teknisi = Teknisi::find()->where(['id_teknisi' => $id_teknisi])
                                        ->one();

            $saldo = $teknisi->saldo;    
            $total_rating = $teknisi->total_rating;    
            $jumlah_pemesanan = $teknisi->jumlah_pemesanan;    

            
            if (isset($diproses)){
                $response['code'] = 200;
                $response['message'] = "Berhasil";
                $response['data']['diproses'] = $diproses;
                $response['data']['selesai'] = $selesai;
                $response['data']['dibayar'] = $dibayar;
                $response['data']['saldo'] = $saldo;
                $response['data']['total_rating'] = $total_rating;
                $response['data']['jumlah_pemesanan'] = $jumlah_pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Gagal";
                $response['data'] = null;
            }
        }

        return $response;
    }
    

    public function actionAddRatingAndKomentar(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_pemesanan = $data['id_pemesanan'];
            $rating = $data['rating'];
            $komentar_rating = $data['komentar_rating'];

            $pemesanan = Pemesanan::find()->where(['id_pemesanan'=>$id_pemesanan])->one();
            $pemesanan->rating = $rating;
            $pemesanan->komentar_rating = $komentar_rating;

            $teknisi = Teknisi::find()->where(['id_teknisi'=>$pemesanan->id_teknisi])->one();
            $teknisi->total_rating += $rating;
            $teknisi->jumlah_pemesanan+=1;

            if ($pemesanan->update(false) && $teknisi->update(false)){
                $response['code'] = 200;
                $response['message'] = "Berhasil mengirimkan rating dan komen kepada ".$teknisi->nama_toko.".";
                $response['data'] = $pemesanan;
            } else {
                $response['code'] = 500;
                $response['message'] = "Gagal mengirimkan rating dan komen kepada ".$teknisi->nama_toko.".";
                $response['data'] = null;
            }

        }

        return $response;
    }

    public function actionViewAllUnratedByNik($nik){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isGet){
            $sql = "SELECT tb_pemesanan.*, tb_teknisi.*, tb_pemesanan.created_at, tb_pemesanan.updated_at FROM tb_pemesanan INNER JOIN tb_teknisi
            WHERE tb_pemesanan.id_teknisi = tb_teknisi.id_teknisi
            AND tb_pemesanan.nik = '$nik' 
            AND tb_pemesanan.proses = 'Dibayar'
            AND tb_pemesanan.rating = '0'
            ORDER BY tb_pemesanan.created_at DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    public static function sendPushNotifToTeknisi($id_teknisi, $title, $body){
        $pushNotifications = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => "825913f1-e596-46cd-a0b8-22d2b6535c3d",
            "secretKey" => "39E2D6ED04F7B5B008D95228D503237F6B3CB96BE3862D4BF16AE31F30D44289",
          ));

          $publishResponse = $pushNotifications->publish(
            // array("hello", "donuts"),
            array(strval($id_teknisi)),
            array(
              "fcm" => array(
                "notification" => array(
                  "title" => $title,
                  "body" => $body,
                  "sound" => "default",
                  "click_action" => "ACTIVITY_ORDERANKU"
                )
              ),
              "data" => array(
                "inAppNotificationMessage" => "Display me somewhere in the app ui!",
              ),
            //   "apns" => array("aps" => array(
            //     "alert" => array(
            //       "title" => "Hi!",
            //       "body" => "This is my first Push Notification!"
            //     )
            //   ))
          ));

        //   echo "<pre>";
        //   var_dump($publishResponse);
        //   exit();
    }

    public static function sendPushNotifToMasyarakat($nik, $title, $body){
        $pushNotifications = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => "825913f1-e596-46cd-a0b8-22d2b6535c3d",
            "secretKey" => "39E2D6ED04F7B5B008D95228D503237F6B3CB96BE3862D4BF16AE31F30D44289",
          ));

          $publishResponse = $pushNotifications->publish(
            // array("hello", "donuts"),
            array(strval($nik)),
            array(
              "fcm" => array(
                "notification" => array(
                  "title" => $title,
                  "body" => $body,
                  "sound" => "default",
                  "click_action" => "ACTIVITY_ORDERANKU"
                )
              ),
              "data" => array(
                "inAppNotificationMessage" => "Display me somewhere in the app ui!",
              ),
            //   "apns" => array("aps" => array(
            //     "alert" => array(
            //       "title" => "Hi!",
            //       "body" => "This is my first Push Notification!"
            //     )
            //   ))
          ));

        //   echo "<pre>";
        //   var_dump($publishResponse);
        //   exit();
    }
}