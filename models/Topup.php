<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_topup".
 *
 * @property int $id_topup
 * @property string $nik
 * @property int $nominal
 * @property string $created_at
 * @property string $updated_at
 * @property string $foto
 * @property string $proses
 *
 * @property TbMasyarakat $nik0
 */
class Topup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_topup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nik', 'nominal', 'foto'], 'required'],
            [['nominal'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['proses'], 'string'],
            [['nik'], 'string', 'max' => 16],
            [['foto'], 'string', 'max' => 100],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => Masyarakat::className(), 'targetAttribute' => ['nik' => 'nik']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_topup' => 'Id Topup',
            'nik' => 'Nik',
            'nominal' => 'Nominal',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'foto' => 'Foto',
            'proses' => 'Proses',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNik0()
    {
        return $this->hasOne(Masyarakat::className(), ['nik' => 'nik']);
    }
}
