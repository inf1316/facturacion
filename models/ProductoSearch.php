<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    public $categoriaValue;
    public  $marcaValue;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'id_marca', 'id_categoria', 'stock'], 'integer'],
            [['precio'], 'safe'],
            [['categoriaValue', 'marcaValue', 'vencimiento'], 'safe']
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
        $query = Producto::find()->joinWith(['marca'])
                                 ->joinWith(['marca.categoria']);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['categoriaValue'] = [
            'asc' => ['marca.categoria.nombreCategoria' => SORT_ASC],
            'desc' => ['marca.categoria.nombreCategoria' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['marcaValue'] = [
            'asc' => ['marca.nombreMarca' => SORT_ASC],
            'desc' => ['marca.nombreMarca' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_producto' => $this->id_producto,
            'id_marca' => $this->id_marca,
            'id_categoria' => $this->id_categoria,
            'stock' => $this->stock,
            'precio' => $this->precio,

        ])->andFilterWhere(['ilike', 'categoria.nombreCategoria', $this->categoriaValue])
          ->andFilterWhere(['ilike', 'marca.nombreMarca', $this->marcaValue]);

        return $dataProvider;
    }
}
