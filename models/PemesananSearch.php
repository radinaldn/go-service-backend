<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pemesanan;

/**
 * PemesananSearch represents the model behind the search form of `app\models\Pemesanan`.
 */
class PemesananSearch extends Pemesanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pemesanan', 'id_teknisi', 'biaya'], 'integer'],
            [['nik', 'alamat', 'created_at', 'updated_at', 'jenis_servis', 'proses', 'kategori_bayar', 'foto_sebelum', 'foto_sesudah', 'ket'], 'safe'],
            [['lat', 'lng'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pemesanan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pemesanan' => $this->id_pemesanan,
            'id_teknisi' => $this->id_teknisi,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'biaya' => $this->biaya,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'jenis_servis', $this->jenis_servis])
            ->andFilterWhere(['like', 'proses', $this->proses])
            ->andFilterWhere(['like', 'kategori_bayar', $this->kategori_bayar])
            ->andFilterWhere(['like', 'foto_sebelum', $this->foto_sebelum])
            ->andFilterWhere(['like', 'foto_sesudah', $this->foto_sesudah])
            ->andFilterWhere(['like', 'ket', $this->ket]);

        return $dataProvider;
    }
}
