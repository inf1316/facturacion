<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Marca */

$this->title = Yii::t('app', 'Actualizar Marca: {name}', [
    'name' => $model->id_marca,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_marca, 'url' => ['view', 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="marca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
