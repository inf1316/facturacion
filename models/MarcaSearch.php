<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Marca;

/**
 * MarcaSearch represents the model behind the search form of `app\models\Marca`.
 */
class MarcaSearch extends Marca
{
    public $categoriaValue;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_marca', 'id_categoria'], 'integer'],
            [['nombreMarca', 'categoriaValue'], 'safe'],
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
        $query = Marca::find()->joinWith(['categoria']);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['categoriaValue'] = [
            'asc' => ['categoria.nombreCategoria' => SORT_ASC],
            'desc' => ['categoria.nombreCategoria' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_marca' => $this->id_marca,
        ]);

        $query->andFilterWhere(['ilike', 'nombreMarca', $this->nombreMarca])
              ->andFilterWhere(['ilike', 'categoria.nombreCategoria', $this->categoriaValue]);

        return $dataProvider;
    }
}
