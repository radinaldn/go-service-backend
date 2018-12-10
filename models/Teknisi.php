<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_teknisi".
 *
 * @property int $id_teknisi
 * @property string $nama_toko
 * @property string $nama_pemilik
 * @property string $nik_pemilik
 * @property string $layanan
 * @property string $alamat
 * @property string $no_hp
 * @property double $lat
 * @property double $lng
 * @property string $siu
 * @property string $foto
 * @property string $status_akun
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TbPemesanan[] $tbPemesanans
 */
class Teknisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_teknisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_toko', 'nama_pemilik', 'nik_pemilik', 'layanan', 'alamat', 'no_hp', 'lat', 'lng', 'siu', 'foto', 'password'], 'required'],
            [['layanan', 'alamat', 'status_akun', 'password'], 'string'],
            [['lat', 'lng', 'saldo'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_toko', 'nama_pemilik'], 'string', 'max' => 150],
            [['nik_pemilik'], 'string', 'max' => 16],
            [['no_hp'], 'string', 'max' => 12],
            [['siu', 'foto'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_teknisi' => 'Id Teknisi',
            'nama_toko' => 'Nama Toko',
            'nama_pemilik' => 'Nama Pemilik',
            'nik_pemilik' => 'Nik Pemilik',
            'password' => 'Password',
            'layanan' => 'Layanan',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'siu' => 'Siu',
            'foto' => 'Foto',
            'status_akun' => 'Status Akun',
            'saldo' => 'Saldo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPemesanans()
    {
        return $this->hasMany(Pemesanan::className(), ['id_teknisi' => 'id_teknisi']);
    }
}
