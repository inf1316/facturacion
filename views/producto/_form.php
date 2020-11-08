<?php

use kartik\date\DatePicker;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>


<?php
$select2Options = [
    'multiple' => false,
    'theme' => 'krajee',
    'placeholder' => 'Seleccione la Marca',
    'width' => '100%',
];
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'id_categoria')->widget(Select2::className(), [
            'data' => ArrayHelper::map(\app\models\Categoria::find()->all(), 'id_categoria', 'nombreCategoria'),
            'language' => 'es',
            'options' => ['placeholder' => 'Seleccione la Categoría'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
            'pluginEvents' => [
                'select2:select' => 'function(e) { populateClientCode(e.params.data.id); hasExpired(e.params.data.id); }',
            ],
        ]);
    ?>

    <?php
        if (!$model->isNewRecord) {
            echo $form->field($model, 'id_marca')->widget(Select2::className(), [
                'data' => ArrayHelper::map(\app\models\Marca::find()->all(), 'id_marca', 'nombreMarca'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione la Marca'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
        } else {
            echo $form->field($model, 'id_marca')->widget(Select2::className(), [
                'data' => [],
                'language' => 'es',
                'options' => $select2Options,
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
        }
    ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'stock')->textInput(['type' => 'number']) ?>
            <?= $form->field($model, 'precio')->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    'prefix' => '₲ ',
                    'allowMinus' => false,
                    'rightAlign' => false
                ],
            ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'codigo')->textInput() ?>

            <div class="form-group field-producto-codigobarra required">
                <div class="form-group field-producto-codigobarra required">
                    <?= $form->field($model, 'codigoBarra')->textInput(['readonly' => true, 'style'=>'width: 92%']) ?>

                    <div style="float: right; margin-top: -3.5em" >
                        <button class="btn btn-success"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div id="showExperation" hidden="hidden">
       <?php
           echo $form->field($model, 'vencimiento')->widget(DatePicker::classname(), [
               'pluginOptions' => [
                   'autoclose'=>true,
               ]
           ]);
       ?>
   </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function populateClientCode(client_id) {
        var url = '<?= Url::to(['marca/populate-brand-code', 'id' => '-id-']) ?>';
        var $select = $('#producto-id_marca');
        $select.find('option').remove().end();

        $.ajax({
            url: url.replace('-id-', client_id),
            success: function (data) {
                var select2Options = <?= Json::encode($select2Options) ?>;
                select2Options.data = data.data;

                $select.select2(select2Options);
                $select.val(data.selected).trigger('change');
            }
        });
    }

    function hasExpired(idCategory) {
        var url = '<?= Url::to(['categoria/has-expired', 'id' => '-id-']) ?>';

        $.ajax({
            url: url.replace('-id-', idCategory),
            success: function (data) {
                if (data === '0') {
                    $('#showExperation').removeAttr('hidden');
                }
                else {
                    $('#showExperation').attr('hidden', 'hidden');
                }
            }
        });
    }
</script>
