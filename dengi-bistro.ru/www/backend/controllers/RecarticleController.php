<?php

namespace backend\controllers;

use Yii;
use common\models\RecArticle;
use common\models\RecArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RecarticleController implements the CRUD actions for RecArticle model.
 */
class RecarticleController extends Controller
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
     * Lists all RecArticle models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new RecArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single RecArticle model.
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
     * Creates a new RecArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new RecArticle();

        if ($model->load(Yii::$app->request->post()) ) 
        {
            if(UploadedFile::getInstance($model, 'img1'))
            {
                $model->img1=UploadedFile::getInstance($model, 'img1');
                $model->img1->saveAs('../../frontend/web/img/'.$model->img1->baseName.".".$model->img1->extension);
                $model->img1=$model->img1->baseName.".".$model->img1->extension;  
            }
            if(UploadedFile::getInstance($model, 'img2'))
            {
                $model->img2=UploadedFile::getInstance($model, 'img2');
                $model->img2->saveAs('../../frontend/web/img/'.$model->img2->baseName.".".$model->img2->extension);
                $model->img2=$model->img2->baseName.".".$model->img2->extension;  
            }
            if(UploadedFile::getInstance($model, 'img3'))
            {
                $model->img3=UploadedFile::getInstance($model, 'img3');
                $model->img3->saveAs('../../frontend/web/img/'.$model->img3->baseName.".".$model->img3->extension);
                $model->img3=$model->img3->baseName.".".$model->img3->extension;  
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing RecArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img1 = $model->img1;
        $img2 = $model->img2;
        $img3 = $model->img3;
        if ($model->load(Yii::$app->request->post()))
        {
            if(UploadedFile::getInstance($model, 'img1'))
            {
                $model->img1=UploadedFile::getInstance($model, 'img1');
                $model->img1->saveAs('../../frontend/web/img/'.$model->img1->baseName.".".$model->img1->extension);
                $model->img1=$model->img1->baseName.".".$model->img1->extension;  
            }
            else
                $model->img1 = $img1;
                
            if(UploadedFile::getInstance($model, 'img2'))
            {
                $model->img2=UploadedFile::getInstance($model, 'img2');
                $model->img2->saveAs('../../frontend/web/img/'.$model->img2->baseName.".".$model->img2->extension);
                $model->img2=$model->img2->baseName.".".$model->img2->extension;  
            }
            else
                $model->img2 = $img2;
                
            if(UploadedFile::getInstance($model, 'img3'))
            {
                $model->img3=UploadedFile::getInstance($model, 'img3');
                $model->img3->saveAs('../../frontend/web/img/'.$model->img3->baseName.".".$model->img3->extension);
                $model->img3=$model->img3->baseName.".".$model->img3->extension;  
            }
            else
                $model->img3 = $img3;
                
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RecArticle model.
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
     * Finds the RecArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
