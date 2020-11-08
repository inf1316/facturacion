<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id_producto
 * @property int $id_marca
 * @property int $id_categoria
 * @property bool|null $estado
 * @property string $codigo
 * @property string $codigoBarra
 * @property int $stock
 * @property float|null $precio
 *
 * @property Descuento[] $descuentos
 * @property Marca $marca
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_marca', 'id_categoria', 'codigo', 'stock'], 'required'],
            [['id_marca', 'id_categoria', 'stock', 'estado'], 'default', 'value' => null],
            [['id_marca', 'id_categoria', 'stock'], 'integer'],
            [['estado'], 'boolean'],
            [['precio'], 'string', 'max' => 200],
            [['codigo'], 'string', 'max' => 50],
            [['codigoBarra'], 'string', 'max' => 40],
            [['vencimiento'], 'string', 'max' => 40],
            [['id_marca', 'id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['id_marca' => 'id_marca', 'id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'id_marca' => 'Marca',
            'id_categoria' => 'Categoría',
            'estado' => 'Estado',
            'codigo' => 'Código',
            'codigoBarra' => 'Código Barra',
            'stock' => 'Stock',
            'precio' => 'Precio',
            'vencimento' => 'Vencimiento',
        ];
    }

    /**
     * Gets query for [[Descuentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDescuentos()
    {
        return $this->hasMany(Descuento::className(), ['id_producto' => 'id_producto', 'id_marca' => 'id_marca', 'id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Marca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['id_marca' => 'id_marca', 'id_categoria' => 'id_categoria']);
    }
}
