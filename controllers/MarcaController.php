<?php

namespace app\controllers;

use Yii;
use app\models\Marca;
use app\models\MarcaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MarcaController implements the CRUD actions for Marca model.
 */
class MarcaController extends Controller
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
     * Lists all Marca models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MarcaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Marca model.
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_marca, $id_categoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_marca, $id_categoria),
        ]);
    }

    /**
     * Creates a new Marca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Marca();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->save()){
                Yii::$app->session->setFlash('success', "Marca agregada correctamente.");
                return $this->redirect(['index']);
            }
            else {
                Yii::$app->session->setFlash('error', "Marca no agregada correctamente.");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Marca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_marca, $id_categoria)
    {
        $model = $this->findModel($id_marca, $id_categoria);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                Yii::$app->session->setFlash('success', "Marca actualizada correctamente.");
                return $this->redirect(['index']);
            }
            else {
                Yii::$app->session->setFlash('error', "Marca no actualizadas correctamente.");
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Marca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_marca, $id_categoria)
    {
        $this->findModel($id_marca, $id_categoria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Marca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_marca
     * @param integer $id_categoria
     * @return Marca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_marca, $id_categoria)
    {
        if (($model = Marca::findOne(['id_marca' => $id_marca, 'id_categoria' => $id_categoria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionPopulateBrandCode($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $brandCodes = Marca::find()->andWhere(['id_categoria' => $id])->all();
        $data = [['id' => '', 'text' => '']];

        foreach ($brandCodes as $brand) {
            $data[] = ['id' => $brand->id_marca, 'text' => $brand->nombreMarca];
        }
        return ['data' => $data];
    }
}
