<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Descuento;

/**
 * DescuentoSearch represents the model behind the search form of `app\models\Descuento`.
 */
class DescuentoSearch extends Descuento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_descuento', 'id_producto', 'id_marca', 'id_categoria'], 'integer'],
            [['fechaLimite', 'decuento'], 'safe'],
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
        $query = Descuento::find();

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
            'id_descuento' => $this->id_descuento,
            'id_producto' => $this->id_producto,
            'id_marca' => $this->id_marca,
            'id_categoria' => $this->id_categoria,
            'fechaLimite' => $this->fechaLimite,
        ]);

        $query->andFilterWhere(['ilike', 'decuento', $this->decuento]);

        return $dataProvider;
    }
}
