<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_producto, $id_marca, $id_categoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_producto, $id_marca, $id_categoria),
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_producto' => $model->id_producto, 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_producto, $id_marca, $id_categoria)
    {
        $model = $this->findModel($id_producto, $id_marca, $id_categoria);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_producto' => $model->id_producto, 'id_marca' => $model->id_marca, 'id_categoria' => $model->id_categoria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_producto, $id_marca, $id_categoria)
    {
        $this->findModel($id_producto, $id_marca, $id_categoria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_producto
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_producto, $id_marca, $id_categoria)
    {
        if (($model = Producto::findOne(['id_producto' => $id_producto, 'id_marca' => $id_marca, 'id_categoria' => $id_categoria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
