<?php

namespace app\controllers;

use Yii;
use app\models\SupplyList;
use app\models\SupplyListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\BudgetGroup;
/**
 * SupplyListController implements the CRUD actions for SupplyList model.
 */
class SupplyListController extends Controller
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
     * Lists all SupplyList models.
     * @return mixed
     */
    public function actionIndex($gid)
    {
        $searchModel = new SupplyListSearch();
        $searchModel->group_id = $gid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'group_id' => $gid
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($gid)
    {
        $model = new SupplyList();

        if ($model->load(Yii::$app->request->post())) {
          $model->nsn = (isset($model->nsn) && !empty($model->nsn))?substr($model->nsn,0,13):'';
          if($model->save()){
            return $this->redirect(['index', 'gid' => $model->group_id]);
          }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SupplyList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$gid)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'gid' => $model->group_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SupplyList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$gid)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index','gid'=>$gid]);
    }

    /**
     * Finds the SupplyList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SupplyList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupplyList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNsnList($q = null) {
      $query = new \yii\db\Query;

      $query->select('nsn,name')
          ->from('catalog_item')
          ->where('name LIKE "%' . $q .'%"')
          ->orWhere('nsn LIKE "%' . $q .'%"')
          ->orderBy('nsn');
      $command = $query->createCommand();
      $data = $command->queryAll();
      $out = [];
      foreach ($data as $d) {
          $out[] = ['id'=>$d['nsn'],'value' => $d['nsn']."-".$d['name']];
      }
      echo \yii\helpers\Json::encode($out);
    }

    public function actionSupplyList($q = null) {
      $query = new \yii\db\Query;
      $query->select('name,gpsc,price,unit_issue')
          ->from('catalog_item')
          ->where('nsn LIKE "%' . $q .'%"');
      $command = $query->createCommand();
      $data = $command->queryOne();
      echo \yii\helpers\Json::encode($data);
    }
}
