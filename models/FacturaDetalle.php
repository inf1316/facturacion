<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factura_detalle".
 *
 * @property int $id_detatlle
 * @property int $id_producto
 * @property int $numero_factura
 * @property string $numeroDetalle
 * @property float $precio
 * @property float|null $cantidad
 * @property int $id_marca
 * @property int $id_categoria
 *
 * @property Factura $numeroFactura
 * @property Producto $producto
 */
class FacturaDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'numero_factura', 'numeroDetalle', 'precio', 'id_marca', 'id_categoria'], 'required'],
            [['id_producto', 'numero_factura', 'id_marca', 'id_categoria'], 'default', 'value' => null],
            [['id_producto', 'numero_factura', 'id_marca', 'id_categoria'], 'integer'],
            [['precio', 'cantidad'], 'number'],
            [['numeroDetalle'], 'string', 'max' => 100],
            [['numero_factura'], 'exist', 'skipOnError' => true, 'targetClass' => Factura::className(), 'targetAttribute' => ['numero_factura' => 'numero_factura']],
            [['id_producto', 'id_marca', 'id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['id_producto' => 'id_producto', 'id_marca' => 'id_marca', 'id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detatlle' => 'Id Detatlle',
            'id_producto' => 'Id Producto',
            'numero_factura' => 'Numero Factura',
            'numeroDetalle' => 'Numero Detalle',
            'precio' => 'Precio',
            'cantidad' => 'Cantidad',
            'id_marca' => 'Id Marca',
            'id_categoria' => 'Id Categoria',
        ];
    }

    /**
     * Gets query for [[NumeroFactura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumeroFactura()
    {
        return $this->hasOne(Factura::className(), ['numero_factura' => 'numero_factura']);
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
