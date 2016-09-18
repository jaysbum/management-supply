<?php

namespace app\controllers;

use Yii;
use app\models\RequestItem;
use app\models\RequestItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * RequestItemController implements the CRUD actions for RequestItem model.
 */
class RequestItemController extends Controller
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
     * Lists all RequestItem models.
     * @return mixed
     */
    public function actionIndex($rid)
    {
        $searchModel = new RequestItemSearch();
        $searchModel->request_id = $rid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequestItem model.
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
     * Creates a new RequestItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($rid)
    {
        $model = new RequestItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setFlash('เพิ่ม');
            return $this->redirect(['index', 'rid' => $rid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RequestItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$rid)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setFlash('แก้ไข');
            return $this->redirect(['index', 'rid' => $rid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RequestItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$rid)
    {
        $this->findModel($id)->delete();
        $this->setFlash('ลบ');
        return $this->redirect(['index', 'rid' => $rid]);
    }

    /**
     * Finds the RequestItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function setFlash($text)
    {
        Yii::$app->getSession()->setFlash('alert',[
                'body'=>'ดำเนินการ'.$text.'ข้อมูลเรียบร้อย',
                'options'=>['class'=>'alert-success']
        ]);
    }
    public function actionGetBudget($id)
    {
        return \app\models\SupplyList::findOne($id)->remaining;
    }
    public function actionGetBudgetData($id)
    {
        echo \yii\helpers\Json::encode(\app\models\SupplyList::findOne($id));
    }
}
