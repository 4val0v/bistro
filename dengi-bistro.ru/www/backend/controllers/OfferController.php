<?php

namespace backend\controllers;

use Yii;
use common\models\Offer;
use common\models\OfferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Folderoffer;

/**
 * OfferController implements the CRUD actions for Offer model.
 */
class OfferController extends MyController
{
    public function actionIndex($id = false)
    {        
        if ($id){$ids = (new Folderoffer)->getIds($id);} 
        else{
        $free = (new Offer)->getFreepage();}
        $foldername = (new Folderoffer)->getFoldername($id);
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ids, $free);
        $folders = (new Folderoffer)->getAll();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'folders' => $folders,
            'id' => $id,
            'foldername' => $foldername,
            'ids'=>$ids,
            'free'=>$free
        ]);
    }

    /**
     * Displays a single Offer model.
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
     * Creates a new Offer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Offer();

        if ($model->load(Yii::$app->request->post())) {
            //print_r($model->ids);
            $model->ids = implode(",", $model->ids);
            $model->save();
            //print_r($model->ids);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionGetform($id)
    {
        //$this->layout=false;
        if($id)
        {
            $model=Folderoffer::find()->where(['id'=>$id])->one();
            //$model->ids = explode(",", $model->ids);
            $act='update';
        }
        else
        {
            $model= new Folderoffer();
            $act="create";
        }
            
        return $this->renderAjax('/folderoffer/_form', ['model'=>$model, 'act'=>$act]);
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->ids = explode(",", $model->ids);
        if ($model->load(Yii::$app->request->post()) ) {
            $model->ids = implode(",", $model->ids);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Offer model.
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
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
