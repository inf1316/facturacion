<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Descuento */

$this->title = Yii::t('app', 'Update Descuento: {name}', [
    'name' => $model->id_descuento,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Descuentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_descuento, 'url' => ['view', 'id_descuento' => $model->id_descuento, 'id_producto' => $model->id_producto, 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="descuento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
