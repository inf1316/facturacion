<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id_categoria
 * @property string|null $nombreCategoria
 *
 * @property Marca[] $marcas
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreCategoria'], 'string', 'max' => 100],
            [['perecedera'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id Categoria',
            'nombreCategoria' => 'Nombre Categoria',
            'perecedera' => 'Perecedero',
        ];
    }

    /**
     * Gets query for [[Marcas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcas()
    {
        return $this->hasMany(Marca::className(), ['id_categoria' => 'id_categoria']);
    }
}
