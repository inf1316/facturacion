<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Descuento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="descuento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'id_producto')->widget(Select2::className(), [
            'data' => ArrayHelper::map(\app\models\Producto::find()->all(), 'id_producto', 'codigo'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione el Producto'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
            'pluginEvents' => [
                'select2:select' => 'function(e) { populateClientCode(e.params.data.id); }',
            ],
        ]);
    ?>

    <?= $form->field($model, 'decuento')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'fechaLimite')->widget(DatePicker::classname(), [
            'pluginOptions' => [
                'autoclose'=>true,
            ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
