<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_pemesanan".
 *
 * @property int $id_pemesanan
 * @property string $nik
 * @property int $id_teknisi
 * @property string $alamat
 * @property double $lat
 * @property double $lng
 * @property string $created_at
 * @property string $updated_at
 * @property string $jenis_servis
 * @property int $biaya
 * @property string $proses
 * @property string $kategori_bayar
 * @property string $foto_sebelum
 * @property string $foto_sesudah
 * @property string $ket
 *
 * @property TbMasyarakat $nik0
 * @property TbTeknisi $teknisi
 */
class Pemesanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pemesanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nik', 'id_teknisi', 'alamat', 'lat', 'lng', 'jenis_servis', 'kategori_bayar', 'foto_sebelum', 'keluhan'], 'required'],
            [['id_teknisi', 'biaya', 'rating'], 'integer'],
            [['alamat', 'proses', 'kategori_bayar', 'ket', 'keluhan', 'komentar_rating'], 'string'],
            [['lat', 'lng'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['nik'], 'string', 'max' => 16],
            [['jenis_servis', 'foto_sebelum', 'foto_sesudah'], 'string', 'max' => 100],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => Masyarakat::className(), 'targetAttribute' => ['nik' => 'nik']],
            [['id_teknisi'], 'exist', 'skipOnError' => true, 'targetClass' => Teknisi::className(), 'targetAttribute' => ['id_teknisi' => 'id_teknisi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pemesanan' => 'Id Pemesanan',
            'nik' => 'Nik',
            'id_teknisi' => 'Id Teknisi',
            'alamat' => 'Alamat',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'keluhan' => 'Keluhan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'jenis_servis' => 'Jenis Servis',
            'biaya' => 'Biaya',
            'proses' => 'Proses',
            'kategori_bayar' => 'Kategori Bayar',
            'foto_sebelum' => 'Foto Sebelum',
            'foto_sesudah' => 'Foto Sesudah',
            'ket' => 'Ket',
            'rating' => 'Rating',
            'komentar_rating' => 'Komentar Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNik0()
    {
        return $this->hasOne(Masyarakat::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeknisi()
    {
        return $this->hasOne(Teknisi::className(), ['id_teknisi' => 'id_teknisi']);
    }
}
