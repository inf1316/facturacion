<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categorías');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Agregar Categoría'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
        <?= \kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],

                'nombreCategoria',

                [
                    'attribute' => 'perecedera',
                    'format' => 'raw',
                    'filter' => ['1' => 'Sí', '0' => 'No'],
                    'contentOptions' => [
                        'class' => 'text-center',
                    ],
                    'value' => function ($model) {
                        if ($model->perecedera === '0') {
                            return '<span class="glyphicon glyphicon-ok text-success"></span>'; // check icon
                        } else {
                            return '<span class="glyphicon glyphicon-remove text-danger"></span>'; // "x" icon in red color
                        }
                    },
                ],
                
                [
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>
