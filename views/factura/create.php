<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Factura */

$this->title = Yii::t('app', 'Create Factura');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Facturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
