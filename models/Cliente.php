<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id_persona
 * @property string|null $apellidos
 * @property string|null $ruc
 * @property string|null $email
 * @property string|null $numeroTelefono
 * @property string $nombre
 *
 * @property Factura[] $facturas
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['apellidos', 'ruc', 'email', 'numeroTelefono', 'nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_persona' => 'Id Persona',
            'apellidos' => 'Apellidos',
            'ruc' => 'Ruc',
            'email' => 'Email',
            'numeroTelefono' => 'Numero Telefono',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['id_persona' => 'id_persona']);
    }
}
