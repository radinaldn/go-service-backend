<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Topup;

/**
 * TopupSearch represents the model behind the search form of `app\models\Topup`.
 */
class TopupSearch extends Topup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_topup', 'nominal'], 'integer'],
            [['nik', 'created_at', 'updated_at', 'foto', 'proses'], 'safe'],
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
        $query = Topup::find();

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
            'id_topup' => $this->id_topup,
            'nominal' => $this->nominal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'proses', $this->proses]);

        return $dataProvider;
    }
}
