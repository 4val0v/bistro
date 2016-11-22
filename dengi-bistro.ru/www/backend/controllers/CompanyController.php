<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\CompanySearch;
use backend\models\LoadFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Translit;
use yii\helpers\Json;
use common\models\User;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends MyController
{
    public function actionIndex($active=false)
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $active);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'active'=>$active
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'img'))
            {
                $model->img=UploadedFile::getInstance($model, 'img');
                $model->img->saveAs('../../frontend/web/img/'.$model->img->baseName.".".$model->img->extension);
                $model->img=$model->img->baseName.".".$model->img->extension;  
            }
            if($model->pay)
                $model->pay = implode(",", $model->pay);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img=$model->img;
        $model->pay=explode(",", $model->pay);
        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'img'))
            {
                $model->img=UploadedFile::getInstance($model, 'img');
                $model->img->saveAs('../../frontend/web/img/'.$model->img->baseName.".".$model->img->extension);
                $model->img=$model->img->baseName.".".$model->img->extension;  
            }
            else
                $model->img = $img;
                
            if($model->pay)
                $model->pay = implode(",", $model->pay);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionLoad()
    {
        $model = new LoadFile();
        $path = '../web/excel/';
        
        if ($model->load(Yii::$app->request->post()))
        {
            if(UploadedFile::getInstance($model, 'file'))
            {
                $model->file=UploadedFile::getInstance($model, 'file');
                $model->file->saveAs($path.$model->file->baseName.".".$model->file->extension);
                $file=$path.$model->file->baseName.".".$model->file->extension; 
                
            $data = \moonland\phpexcel\Excel::widget([
            'mode' => 'import', 
            'fileName' => $file, 
            'setFirstRecordAsKeys' => true,
            ]); 
            }
            foreach($data as $d)
            {
                $company = new Company();
            	$company->name = $d['Название']."";
                $company->alias = $d['name-url']."";
                $company->h1 = $d['h1']."";
                $company->title = $d['title']."";
                $company->seo_desc = $d['description']."";
                $company->seo_keys = $d['keywords']."";
                $company->vk_group = $d['Группа_VK']."";
                $company->fb_group = $d['Группа_Fb']."";
                $company->save();
            }
            //print_r($data);
            return $this->redirect(['index']);
        }        
        
        return $this->render('load', [
            'model' => $model,
            'arr'=>$arr
        ]);
    }
}
