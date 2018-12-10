<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_masyarakat".
 *
 * @property string $nik
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jk
 * @property string $alamat
 * @property string $agama
 * @property string $status_kawin
 * @property string $pekerjaan
 * @property string $kewarganegaraan
 * @property string $foto
 * @property string $no_hp
 * @property int $saldo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TbPemesanan[] $tbPemesanans
 * @property TbTopup[] $tbTopups
 */
class Masyarakat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_masyarakat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nik', 'password','nama', 'tempat_lahir', 'tanggal_lahir', 'jk', 'alamat', 'agama', 'status_kawin', 'pekerjaan', 'kewarganegaraan', 'foto', 'no_hp', 'saldo'], 'required'],
            [['tanggal_lahir', 'created_at', 'updated_at'], 'safe'],
            [['jk', 'alamat', 'agama', 'status_kawin', 'kewarganegaraan'], 'string'],
            [['saldo'], 'integer'],
            [['nik'], 'string', 'max' => 16],
            [['nama'], 'string', 'max' => 150],
            [['password'], 'string', 'max' => 255],
            [['tempat_lahir', 'foto'], 'string', 'max' => 100],
            [['pekerjaan'], 'string', 'max' => 50],
            [['no_hp'], 'string', 'max' => 12],
            [['nik'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Nik',
            'password' => 'Password',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jk' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'agama' => 'Agama',
            'status_kawin' => 'Status Kawin',
            'pekerjaan' => 'Pekerjaan',
            'kewarganegaraan' => 'Kewarganegaraan',
            'foto' => 'Foto',
            'no_hp' => 'No Hp',
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
        return $this->hasMany(Pemesanan::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbTopups()
    {
        return $this->hasMany(Topup::className(), ['nik' => 'nik']);
    }
}
