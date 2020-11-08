<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreCategoria')->textInput(['maxlength' => true]) ?>

    <?php
        if ($model->isNewRecord) {
            echo $form->field($model, 'perecedera')->dropDownList(['0' => 'Sí', '1' => 'No'], ['options' => ['1' => ['Selected' => true]]]);
        } else {
            echo $form->field($model, 'perecedera')->dropDownList(['0' => 'Sí', '1' => 'No'], ['options' => [
                '1' => [
                    'Selected' => $model->perecedera == '1' ? true : false
                ],
                '0' => [
                    'Selected' => $model->perecedera == '0' ? true : false
                ]
            ]]);
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
