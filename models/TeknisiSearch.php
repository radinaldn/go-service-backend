<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teknisi;

/**
 * TeknisiSearch represents the model behind the search form of `app\models\Teknisi`.
 */
class TeknisiSearch extends Teknisi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_teknisi'], 'integer'],
            [['nama_toko', 'nama_pemilik', 'nik_pemilik', 'layanan', 'alamat', 'no_hp', 'siu', 'foto', 'status_akun', 'created_at', 'updated_at'], 'safe'],
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
        $query = Teknisi::find();

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
            'id_teknisi' => $this->id_teknisi,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_toko', $this->nama_toko])
            ->andFilterWhere(['like', 'nama_pemilik', $this->nama_pemilik])
            ->andFilterWhere(['like', 'nik_pemilik', $this->nik_pemilik])
            ->andFilterWhere(['like', 'layanan', $this->layanan])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'siu', $this->siu])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'status_akun', $this->status_akun]);

        return $dataProvider;
    }
}
