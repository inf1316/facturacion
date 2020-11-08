<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaDetalle */

$this->title = Yii::t('app', 'Create Factura Detalle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factura Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-detalle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
