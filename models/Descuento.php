<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "descuento".
 *
 * @property int $id_descuento
 * @property int $id_producto
 * @property int $id_marca
 * @property int $id_categoria
 * @property string|null $fechaLimite
 * @property string $decuento
 *
 * @property Producto $producto
 */
class Descuento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'descuento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'id_marca', 'id_categoria', 'decuento'], 'required'],
            [['id_producto', 'id_marca', 'id_categoria'], 'default', 'value' => null],
            [['id_producto', 'id_marca', 'id_categoria'], 'integer'],
            [['fechaLimite'], 'safe'],
            [['decuento'], 'string', 'max' => 20],
            [['id_producto', 'id_marca', 'id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['id_producto' => 'id_producto', 'id_marca' => 'id_marca', 'id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_descuento' => 'Id Descuento',
            'id_producto' => 'Producto',
            'id_marca' => 'Id Marca',
            'id_categoria' => 'Id Categoria',
            'fechaLimite' => 'Fecha Limite',
            'decuento' => 'Descuento',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id_producto' => 'id_producto', 'id_marca' => 'id_marca', 'id_categoria' => 'id_categoria']);
    }
}
