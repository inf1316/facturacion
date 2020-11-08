<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factura".
 *
 * @property int $numero_factura
 * @property int $id_persona
 * @property string|null $tipo
 * @property string $fecha
 *
 * @property Cliente $persona
 * @property FacturaDetalle[] $facturaDetalles
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_persona', 'fecha'], 'required'],
            [['id_persona'], 'default', 'value' => null],
            [['id_persona'], 'integer'],
            [['fecha'], 'safe'],
            [['tipo'], 'string', 'max' => 100],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['id_persona' => 'id_persona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'numero_factura' => 'Numero Factura',
            'id_persona' => 'Id Persona',
            'tipo' => 'Tipo',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Cliente::className(), ['id_persona' => 'id_persona']);
    }

    /**
     * Gets query for [[FacturaDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaDetalles()
    {
        return $this->hasMany(FacturaDetalle::className(), ['numero_factura' => 'numero_factura']);
    }
}
