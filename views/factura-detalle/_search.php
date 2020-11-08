<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaDetalleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-detalle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_detatlle') ?>

    <?= $form->field($model, 'id_producto') ?>

    <?= $form->field($model, 'numero_factura') ?>

    <?= $form->field($model, 'numeroDetalle') ?>

    <?= $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'id_marca') ?>

    <?php // echo $form->field($model, 'id_categoria') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
