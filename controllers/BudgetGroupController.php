<?php

namespace app\controllers;

use Yii;
use app\models\BudgetGroup;
use app\models\BudgetGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BudgetGroupController implements the CRUD actions for BudgetGroup model.
 */
class BudgetGroupController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all BudgetGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BudgetGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['parent_id'=>SORT_ASC,'parent'=>SORT_DESC]];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BudgetGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BudgetGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BudgetGroup();

        if ($model->load(Yii::$app->request->post())) {
              if($model->save()){
                if($model->parent == 1){
                  //update parent id for parent
                  $update_model = BudgetGroup::findOne($model->id);
                  $update_model->parent_id = $model->id;
                  $update_model->update();
                }
                  Yii::$app->getSession()->setFlash('alert',[
                    'body'=>'บันทึกข้อมูลเรียบร้อย',
                      'options'=>['class'=>'alert-success']
                  ]);
                  return $this->redirect(['index']);
              }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BudgetGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
                if($model->save()){
                  Yii::$app->getSession()->setFlash('alert',[
                    'body'=>'บันทึกข้อมูลเรียบร้อย',
                      'options'=>['class'=>'alert-success']
                  ]);
                  return $this->redirect(['index']);
                }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BudgetGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the BudgetGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BudgetGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BudgetGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBudgetLimit($id){
        $model = BudgetGroup::findOne($id);
        return $model->limit;
    }
    public function actionBudgetTotal($id){
        $model = BudgetGroup::findOne($id);
        return $model->sum;
    }
}
