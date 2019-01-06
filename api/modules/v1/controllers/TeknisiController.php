<?php
namespace app\api\modules\v1\controllers;

use Yii;
use app\models\Teknisi;
use yii\rest\Controller;
use yii\web\Response;

class TeknisiController extends Controller{

    public function actionLogin(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $email = $data['nik'];
            $password = sha1($data['password']);

            $teknisi = Teknisi::find()->where(['email' => $email])
                                            ->andWhere(['password' => $password])
                                            ->one();
                                            
        
            if (isset($teknisi)){
                $response['code'] = 200;
                $response['message'] = "Login berhasil!";
                $response['data'] = $teknisi;
            } else {
                $response['code'] = 500;
                $response['message'] = "Login gagal, username atau password salah!";
                $response['data'] = null;
            }

        }
        
        return $response;
    }

    public function actionRegister(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $teknisi = new Teknisi();
            $teknisi->nama_toko = $data['nama_toko'];
            $teknisi->nama_pemilik = $data['nama_pemilik'];
            $teknisi->nik_pemilik = $data['nik_pemilik'];
            $teknisi->password = sha1($data['password']);
            $teknisi->layanan = $data['layanan'];
            $teknisi->alamat = $data['alamat'];
            $teknisi->no_hp = $data['no_hp'];
            $teknisi->lat = $data['lat'];
            $teknisi->lng = $data['lng'];
            $teknisi->siu = $data['siu'];
            $teknisi->foto = $data['foto'];
        
            if ($teknisi->save(false)){
                $response['code'] = 200;
                $response['message'] = "Registrasi berhasil!";
                $response['data'] = $teknisi;
            } else {
                $response['code'] = 500;
                $response['message'] = "Registrasi gagal!";
                $response['data'] = null;
            }
        }

        return $response;
    }

    // fungsi untuk melihat teknisi terdekat
    public function actionFindNearby($myLat, $myLng, $jarak){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_teknisi.id_teknisi, tb_teknisi.email, tb_teknisi.nama_toko, tb_teknisi.nama_pemilik, tb_teknisi.nik_pemilik, tb_teknisi.layanan, tb_teknisi.alamat, tb_teknisi.no_hp, tb_teknisi.lat, tb_teknisi.lng, tb_teknisi.foto, tb_teknisi.status_akun, tb_teknisi.total_rating, tb_teknisi.jumlah_pemesanan,
                    (((acos(sin(('$myLat'*pi()/180)) 
                    * sin((`lat`*pi()/180))+cos(('$myLat'*pi()/180)) 
                    * cos((`lat`*pi()/180)) * cos((('$myLng'- `lng`) 
                    * pi()/180))))*180/pi())*60*1.1515*1.609344) 
                    as jarak FROM `tb_teknisi` 
                    HAVING jarak <= $jarak AND tb_teknisi.status_akun = 'Aktif'
                    ORDER BY jarak ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }    

    public function actionViewSaldo($id_teknisi){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isGet){
            $teknisi = Teknisi::find()->where(['id_teknisi' => $id_teknisi])->one();
            
            if (isset($teknisi)){
                $response['code'] = 200;
                $response['message'] = "Teknisi ditemukan!";
                $response['saldo'] = $teknisi->saldo;
            } else {
                $response['code'] = 500;
                $response['message'] = "Teknisi tidak ditemukan!";
                $response['saldo'] = null;
            }
        }

        return $response;
    }
}
