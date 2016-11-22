<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use common\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Folderpage;
use yii\helpers\Json;
/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends MyController
{
    public function actionIndex($id = false)
    {
        if ($id){$ids = (new Folderpage)->getIds($id);} 
        else{
        $free = (new Page)->getFreepage();}
        $foldername = (new Folderpage)->getFoldername($id);
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ids, $free);
        
        $folders = (new Folderpage)->getAll();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'folders' => $folders,
            'id' => $id,
            'foldername' => $foldername,
            'ids'=>$ids,
            'free'=>$free
        ]);
        //print_r($free);
    }

    /**
     * Displays a single Page model.
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
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post())) {
            
            /*if($model->folder)
            {
                $folder = Folderpage::find()->where(['id' => $model->folder])->one();
                if(!$folder->ids)
                    $folder->ids = $model->id;
                else 
                    $folder->ids .= ",".$model->id;  
                $folder->save();    
            }
            else
            {
                $model->folder = 0;
            }*/
            //if(!$model->folder)
            //    $model->folder = 0;
            $model->save();
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
            $model=Folderpage::find()->where(['id'=>$id])->one();
            //$model->ids = explode(",", $model->ids);
            $act='update';
        }
        else
        {
            $model= new Folderpage();
            $act="create";
        }
            
        return $this->renderAjax('/folderpage/_form', ['model'=>$model, 'act'=>$act]);
    }
    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$old_folder = Folderpage::find()->where(['id' => $model->folder])->one(); 
        if ($model->load(Yii::$app->request->post())) 
        {                     
            /*if($model->folder)
            {
                $pos = ",".$id.",";            
                $old_folder_pos = strpos($old_folder->ids, $pos);
                $old_folder->ids = substr_replace($old_folder->ids, '', $old_folder_pos+1, 2); //удаляет найденную страницу из папки
                $old_folder->save();
                $folder = Folderpage::find()->where(['id' => $model->folder])->one(); 
                if(!$folder->ids)
                    $folder->ids = ",".$model->id.",";
                else 
                    $folder->ids .= $model->id.",";  
                $folder->save();
            }*/
             
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
            //print_r($folder);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
