<?php

namespace app\controllers;

use app\models\Marca;
use app\models\Producto;
use Yii;
use app\models\Descuento;
use app\models\DescuentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DescuentoController implements the CRUD actions for Descuento model.
 */
class DescuentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Descuento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DescuentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Descuento model.
     * @param integer $id_descuento
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_descuento, $id_producto, $id_marca, $id_categoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_descuento, $id_producto, $id_marca, $id_categoria),
        ]);
    }

    /**
     * Creates a new Descuento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Descuento();
        if ($model->load(Yii::$app->request->post())) {

            $model->id_marca = Producto::findOne([
                'id_producto' => $model->id_producto
            ])->id_marca;

            $model->id_categoria = Producto::findOne([
                'id_producto' => $model->id_producto
            ])->id_categoria;

            if($model->save()){
                Yii::$app->session->setFlash('success', "Descuento actualizado correctamente.");
                return $this->redirect(['index']);
            }
            else {
                Yii::$app->session->setFlash('error', "Descuento no actualizadas correctamente.");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Descuento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_descuento
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_descuento, $id_producto, $id_marca, $id_categoria)
    {
        $model = $this->findModel($id_descuento, $id_producto, $id_marca, $id_categoria);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_descuento' => $model->id_descuento, 'id_producto' => $model->id_producto, 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Descuento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_descuento
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_descuento, $id_producto, $id_marca, $id_categoria)
    {
        $this->findModel($id_descuento, $id_producto, $id_marca, $id_categoria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Descuento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_descuento
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return Descuento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_descuento, $id_producto, $id_marca, $id_categoria)
    {
        if (($model = Descuento::findOne(['id_descuento' => $id_descuento, 'id_producto' => $id_producto, 'id_marca' => $id_marca, 'id_categoria' => $id_categoria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
