<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaDetalle */

$this->title = Yii::t('app', 'Update Factura Detalle: {name}', [
    'name' => $model->id_detatlle,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factura Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_detatlle, 'url' => ['view', 'id' => $model->id_detatlle]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="factura-detalle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
