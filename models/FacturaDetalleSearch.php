<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FacturaDetalle;

/**
 * FacturaDetalleSearch represents the model behind the search form of `app\models\FacturaDetalle`.
 */
class FacturaDetalleSearch extends FacturaDetalle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_detatlle', 'id_producto', 'numero_factura', 'id_marca', 'id_categoria'], 'integer'],
            [['numeroDetalle'], 'safe'],
            [['precio', 'cantidad'], 'number'],
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
        $query = FacturaDetalle::find();

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
            'id_detatlle' => $this->id_detatlle,
            'id_producto' => $this->id_producto,
            'numero_factura' => $this->numero_factura,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'id_marca' => $this->id_marca,
            'id_categoria' => $this->id_categoria,
        ]);

        $query->andFilterWhere(['ilike', 'numeroDetalle', $this->numeroDetalle]);

        return $dataProvider;
    }
}
