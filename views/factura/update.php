<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Factura */

$this->title = Yii::t('app', 'Update Factura: {name}', [
    'name' => $model->numero_factura,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Facturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->numero_factura, 'url' => ['view', 'id' => $model->numero_factura]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="factura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
