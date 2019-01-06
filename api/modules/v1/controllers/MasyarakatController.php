<?php
namespace app\api\modules\v1\controllers;

use Yii;
use app\models\Masyarakat;
use yii\rest\Controller;
use yii\web\Response;

class MasyarakatController extends Controller{

    public function actionViewSaldo($nik){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isGet){
            $masyarakat = Masyarakat::find()->where(['nik' => $nik])->one();
            
            if (isset($masyarakat)){
                $response['code'] = 200;
                $response['message'] = "User ditemukan!";
                $response['saldo'] = $masyarakat->saldo;
            } else {
                $response['code'] = 500;
                $response['message'] = "User tidak ditemukan!";
                $response['saldo'] = null;
            }
        }

        return $response;
    }

    public function actionLogin(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $nik = $data['nik'];
            $password = sha1($data['password']);

            $masyarakat = Masyarakat::find()->where(['nik' => $nik])
                                            ->andWhere(['password' => $password])
                                            ->one();
                                            
        
            if (isset($masyarakat)){
                $response['code'] = 200;
                $response['message'] = "Login berhasil!";
                $response['data'] = $masyarakat;
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
            $masyarakat = new Masyarakat();
            $data = Yii::$app->request->post();

            $nik = $data['nik'];
            $password_1 = sha1($data['password_1']);
            $password_2 = sha1($data['password_2']);
            $nama = $data['nama'];
            $tempat_lahir = $data['tempat_lahir'];
            $tanggal_lahir = $data['tanggal_lahir'];
            $jk = $data['jk'];
            $alamat = $data['alamat'];
            $agama = $data['agama'];
            $status_kawin = $data['status_kawin'];
            $pekerjaan = $data['pekerjaan'];
            $kewarganegaraan = $data['kewarganegaraan'];
            $foto = $data['foto'];
            $no_hp = $data['no_hp'];

            if ($password_1==$password_2){
                $masyarakat->nik = $nik;
                $masyarakat->password = $password_1;
                $masyarakat->nama = $nama;
                $masyarakat->tempat_lahir = $tempat_lahir;
                $masyarakat->tanggal_lahir = $tanggal_lahir;
                $masyarakat->jk = $jk;
                $masyarakat->alamat = $alamat;
                $masyarakat->agama = $agama;
                $masyarakat->status_kawin = $status_kawin;
                $masyarakat->pekerjaan = $pekerjaan;
                $masyarakat->kewarganegaraan = $kewarganegaraan;
                $masyarakat->foto = $foto;
                $masyarakat->no_hp = $no_hp;
                $masyarakat->saldo = 0;

                if ($masyarakat->save()){
                    $response['code'] = 200;
                    $response['message'] = "Registrasi berhasil!";
                    $response['data'] = $masyarakat;
                } else {
                    $response['code'] = 500;
                $response['message'] = "Registrasi gagal!";
                $response['data'] = null;
                }
            } else {
                $response['code'] = 500;
                $response['message'] = "Password tidak cocok!";
                $response['data'] = null;
            }

        }

        return $response;

    }

}
?>