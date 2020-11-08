<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Descuento */

$this->title = $model->id_descuento;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Descuentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="descuento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_descuento' => $model->id_descuento, 'id_producto' => $model->id_producto, 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_descuento' => $model->id_descuento, 'id_producto' => $model->id_producto, 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_descuento',
            'id_producto',
            'id_marca',
            'id_categoria',
            'fechaLimite',
            'decuento',
        ],
    ]) ?>

</div>
