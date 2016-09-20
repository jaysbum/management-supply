<?php

namespace app\controllers;

use Yii;
use app\models\CatalogItem;
use app\models\CatalogItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatalogItemController implements the CRUD actions for CatalogItem model.
 */
class CatalogItemController extends Controller
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
     * Lists all CatalogItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatalogItem model.
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
     * Creates a new CatalogItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogItem();

        if ($model->load(Yii::$app->request->post())) {
          /*if(!empty(Yii::$app->request->post('optional'))){
            $option =  explode(',', Yii::$app->request->post('optional'));
            $main_nsn = (int)$model->nsn;
            $i = 0;
            foreach ($option as $key => $value) {
              $i++;
              $model->name = $model->name." ".$value;
              $model->nsn = $main_nsn + $i;
              $model->niin = (int)(substr($model->nsn, 7));
              $model->save();
            }
            return $this->redirect(['index']);
          }else{*/
            $model->niin = substr($model->nsn, 6);
            $model->new = 1;
            $model->parent_nsn = 0;
            //var_dump(Yii::$app->request->post(optional));
            if($model->save()){
              return $this->redirect(['index']);
            }
          //}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CatalogItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CatalogItem model.
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
     * Finds the CatalogItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionLimitNiin($id)
    {
        $limit = \app\models\CatalogGroup::findOne($id);
        $niin = \app\models\CatalogItem::find()->where('niin <= '.$limit['end_niin'].' AND niin >= '.$limit['start_niin'])->max('niin');
        echo ($niin===null)?$limit['start_niin']:(int)$niin + 1;
    }
}
