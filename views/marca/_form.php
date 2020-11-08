<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Marca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'id_categoria')->widget(Select2::className(), [
            'data' => ArrayHelper::map(\app\models\Categoria::find()->all(), 'id_categoria', 'nombreCategoria'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione la Categoría'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    ?>

    <?= $form->field($model, 'nombreMarca')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
