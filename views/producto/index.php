<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Agregar Producto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'columns' => [

            [
                'class' => '\kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return 1;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new \app\models\DescuentoSearch();
                    $dataProvider = $searchModel->search($model->id_producto);

                    return Yii::$app->controller->renderPartial('_index', ['searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],

            [
                'class' => 'kartik\grid\SerialColumn'
            ],

            [
                'attribute' => 'categoriaValue',
                'label' => 'Categoría',
                'value' => 'marca.categoria.nombreCategoria',
            ],

            [
                'attribute' => 'marcaValue',
                'label' => 'Marca',
                'value' => 'marca.nombreMarca',
            ],

            'stock',

            [
                'attribute' => 'precio',
                'value' => 'precio',
                'label' => '₲ Precio ',
                'format' => ['decimal', 0]
            ],

            'vencimiento',

            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
