<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Company;
use frontend\models\CreditForm;
use yii\helpers\Html;
use common\models\Page;
use common\models\Offer;
use frontend\components\VkAuth;
use frontend\components\FbAuth;
use frontend\models\ReviewForm;
use common\models\Review;
use common\models\Bottommenu;
use common\models\RecArticle;
use common\models\RecCompany;
use yii\helpers\Json;
use frontend\components\Wall;
use frontend\components\WallFB;
use common\models\Theme;

class MainController extends \yii\web\Controller
{
    public $layout="dengi";
    public function beforeAction($action)
    {            
        if ($action->id == 'company') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    public function actionIndex($ids=false, $sortby=false, $sort=false, $pay=false, $old=false)
    {
        $model=new CreditForm();
        $sharp='';
        $default_sum = (new Theme)->getSum();
        $sum=$default_sum;
        if ($model->load(Yii::$app->request->post()))
        {
            $comps=(new Company())->getCompanies(Html::encode($model->sum), Html::encode($model->termin), Html::encode($model->where));
            $companies=$comps[0];
            $ids=$comps[1];
            $sum=Html::encode($model->sum);
            $sortby=false; $sort=false; $pay=false; $old=false;
            $sharp='companies';
        }
        else if(!$ids)
        {
            $comps=(new Company())->getCompanies($default_sum);
            $companies=$comps[0];
            $sum=$default_sum;
            $ids=$comps[1];
        }
        else
        {
            $companies=(new Company())->getCompaniesSort($ids, $sortby, $sort, $pay, $old);
            $sharp="company_list";
        }
        
        $bottommenu = Bottommenu::find()->all();
        
        return $this->render('index', [
            'model'=>$model,
            'companies'=>$companies,
            'sum'=>$sum,
            'ids'=>$ids,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
            'sharp'=>$sharp,
            'bottommenu' => $bottommenu,
        ]);
        //print_r($default_sum);
    }
    
    public function actionLanding($alias, $ids=false, $sortby=false, $sort=false, $pay=false, $old=false)
    {
        $page = (new Page)->getPage($alias);
        if(!$page)
        {
            return $this->render('/site/error');
        }
        
        if($page->offer_id)
        {
            if($ids)
            {
                $comp_info=(new Company())->getCompaniesSort($ids, $sortby, $sort, $pay, $old);
                //$sharp="company_list";
            }
            else{
                $comp_ids = Offer::find()->select('ids')->where(['id' => $page->offer_id])->one()->ids;
                $ids=$comp_ids;
                $comp_ids = explode(",", $comp_ids);
                $comp_info = Company::find()->where(['id' => $comp_ids])->all();
            }
        }
        
        $rec = (new RecArticle)->getPreview();
        $articles = (new RecArticle)->getArticles();
        return $this->render('landing',[
            'page' => $page,
            //'cid' => $comp_ids,
            'comp_info' => $comp_info,
            'sum'=>$sum,
            'ids'=>$ids,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
            'rec' => $rec,
            'articles' => $articles,
        ]);
    }
    public function actionVseKompanii($sortby=false, $sort=false, $pay=false, $old=false)
    {
        if($sortby || $pay || $old)
        {
            $comp_info=(new Company())->getCompaniesSortAll($sortby, $sort, $pay, $old);
        }
        else{
            $comp_info = Company::find()->all();
        }
        return $this->render('vse-kompanii',[
            'companies' => $comp_info,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
        ]);
    }
    public function actionBlog()
    {
        $articles = Page::find()->where(['like', 'alias', 'blog/'])->all();
        $rec = (new RecArticle)->getPreview();
        foreach($articles as $a)
        {
            if($a->id == $rec->article1)
                $img[] = $rec->img1;
            elseif($a->id == $rec->article2)
                $img[] = $rec->img2;
            elseif($a->id == $rec->article3)
                $img[] = $rec->img3;    
        }
        
        return $this->render('blog',[
            'articles'=>$articles,
            'img' => $img,
        ]);
    }
    public function actionCompany($alias, $uforom=false)
    {
        $company=(new Company())->getCompany($alias);
        $data = Yii::$app->cache->get('wall_time');
        if ($data === false) {
            $d=Theme::find()->select('wall_update')->where(['id'=>1])->one()->wall_update;
            Yii::$app->cache->set('wall_time', $d, $d);
        }
        if(!$company)
        {
            return $this->render('/site/error');
        }
        else
        {
            $vkauth = new VkAuth($alias);
            $vkhref=$vkauth->getHref();
            $fbauth = new FbAuth($alias);
            $fbhref=$fbauth->getHref();
            if($company->vk_group) {$wall=(new Wall($company->vk_group))->getWall();}
            else if($company->fb_group && !$company->vk_group) {$fb_wall=(new WallFB($company->fb_group))->getWall();}
            $model=new ReviewForm();
            $model->star=3;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) 
            {
                if ($model->saveReview($company->id))
                {
                    $model=new ReviewForm();
                    $model->star=3;
                }
            }
            if (isset($_GET['code']) && isset($_GET['ufrom']) && $_GET['ufrom']=="vk") {
                $userInfo=$vkauth->loginUser($_GET['code']);
                if($userInfo)
                    $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
            }
            if (isset($_GET['code']) && isset($_GET['ufrom']) && $_GET['ufrom']=="fb") {
                $userInfo=$fbauth->loginUser($_GET['code']);
                if($userInfo)
                    $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
            }
            
            $rec = (new RecCompany)->getCompany();
           return $this->render('company',
            [
                'company'=>$company,
                'vkhref'=>$vkhref,
                'fbhref'=>$fbhref,
                'userInfo'=>$userInfo,
                'model'=>$model,
                'sort'=>$sort,
                'sort_desc'=>$sort_desc,
                'alias'=>$alias,
                'wall'=>$wall,
                'fb_wall'=>$fb_wall,
                'rec' => $rec,
                'data'=>$data
                //'wall_cach'=>Theme::find()->select('wall_cach')->where(['id'=>1])->one()
            ]);
        }        
    }
    public function actionPlus($id)
    {
        if(Yii::$app->user->identity->id)
        {
            $review=Review::findOne(['id'=>$id]);
            $users=$review->user_ids_like;
            $likes=$review->likes;
            if(!strripos($users, Yii::$app->user->identity->id.""))
            {
                $likes++;
                $review->likes=$likes;
                $review->user_ids_like=$review->user_ids_like.",".Yii::$app->user->identity->id;
                $review->save();
                echo Json::encode(['likes'=>$likes]);
            }
            else echo Json::encode(['likes'=>$likes]);
        }
        else
            echo Json::encode(['likes'=>"no"]);  
    }
    public function actionMinus($id)
    {
        if(Yii::$app->user->identity->id)
        {
            $review=Review::findOne(['id'=>$id]);
            $users=$review->user_ids_dislike;
            $likes=$review->likes;
            if(!strripos($users, Yii::$app->user->identity->id.""))
            {
                $likes--;
                $review->likes=$likes;
                $review->user_ids_dislike=$review->user_ids_dislike.",".Yii::$app->user->identity->id;
                $review->save();
                echo Json::encode(['likes'=>$likes]);
            }
            else echo Json::encode(['likes'=>$likes]);
        }
        else
            echo Json::encode(['likes'=>"no"]);  
    }
    public function actionLink($id)
    {
        echo Company::find()->select('href')->where(['id'=>$id])->one()->href;
    }
    public function actionLogout($alias)
    {
        Yii::$app->user->logout();
        
        return $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
    }
}
