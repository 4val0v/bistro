<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;
use common\models\Review;
use yii\widgets\Pjax;
$this->title = $company->title;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$company->seo_desc
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$company->seo_keys
]);
?>
<div class="container-fluid onecompany">
    <div class="combord">
        <div class="compinfo">
            <div class="left">
                <div class="divimg">
                    <img class="logocomp" src="/frontend/web/img/<?=$company->img;?>" alt="<?=$company->name;?>"/><br />
                    <img class="locdec" src="/frontend/web/img/logodeccomp.png"/>
                    <h1><?=$company->h1;?></h1>
                </div>
            </div>
            <div class="right">
                <p>Максимальная сумма кредита<span><?=$company->max_sum;?> р.</span></p>
                <p>Срок кредитования до<span><?=$company->termin;?></span></p>
                <p>Способ выплаты<span>
                    <?php if(strpos($company->pay, '1')!==false){?>
                    <img src="/frontend/web/img/opl1.png" alt="На карту" title="На карту"/>
                    <?php }?>
                    <?php if(strpos($company->pay, '2')!==false){?>
                    <img src="/frontend/web/img/opl2.png" alt="Наличными" title="Наличными"/>
                    <?php }?>
                    <?php if(strpos($company->pay, '3')!==false){?>
                    <img src="/frontend/web/img/olp3.png" alt="На дом" title="На дом"/>
                    <?php }?>
                    <?php if(strpos($company->pay, '4')!==false){?>
                    <img src="/frontend/web/img/opl4.png" alt="Яндекс.Деньги" title="Яндекс.Деньги"/>
                    <?php }?>
                </span></p>
                <p>Возраст заемщика<span>от <?=$company->age;?></span></p>
                <p>Рейтинг<span>
                    <?php 
                    $full=$company->stars;
                    $pol=5-$full;
                    for($i=0;$i<$full;$i++){?>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <?php }
                    for($i=0;$i<$pol;$i++){?>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <?php }?>
                </span></p>
            </div>
            <div class="clear"></div>
            <div class="desc">
                <?=$company->desc;?>
            </div>           
        </div>
    </div>
    <?php if($company->href){?>
    <div class="findk">
        <a data-id="<?=$company->id;?>" class="getcredit" href="#" target="_blank">Получить кредит</a>
    </div> 
    <?php } else {?>
    <div class="nofindk">
        <span>
        К сожалению, на данный момент компания не выдает займы.<br />
        Попробуйте <a id="torecomend" href="#recomend">похожие предложения</a>
        </span>
    </div>
    <?php }?>
</div>

<?php Pjax::begin(['id' => 'my-pjaxxx']);?>
<div class="container reviews">
    <div class="pod_title">
        <h2>ОТЗЫВЫ о <?=$company->h1;?></h2>
        <img src="/frontend/web/img/lend_title.png" alt="Отзывы"/>
    </div>
    <?php if(!$company->comments){?>
    <div class="noreviews">
        <div class="alert alert-warning" role="alert">Отзывов пока что нет.</div>
    </div>
    <?php } else { ?>
    <?php 
    //$comments=(new Review)->getAllinCompany($company->id, $sort, $sort_desc);
    $comments=$company->comments;
    foreach($comments as $com){?>
    <div class="review_border container" style="<?php if($com->strip){?>border-top: 10px solid <?=$com->strip;?>;<?php }?>">
        <div class="review row" style="background: <?=$com->color;?>;">
            <div class="col-md-2 col-sm-4">
                <div class="bord_img">
                    <img src="<?=$com->user->photo;?>" alt="<?=$com->user->name;?>"/>
                </div>  
            </div>
            <div class="col-md-8 col-sm-8">
                <div class="name"><a  target="_blank" href="<?=$com->user->user_href;?>"><?=$com->user->name;?></a>
                <span>
                <?php 
                $full=$com->stars;
                $pol=5-$full;
                for($i=0;$i<$full;$i++){?>
                <i class="fa fa-star" aria-hidden="true"></i>
                <?php }
                for($i=0;$i<$pol;$i++){?>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php }?>
                </span>
                </div>
                <p><?=$com->text;?></p>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-6">
                        <div class="date"><?=date("d:m:Y",$com->date);?></div>
                    </div>
                    <div class="col-md-12  col-sm-6 col-xs-6">
                        <div class="likes">
                            <span class="title">Рейтинг отзыва</span><br />
                            <span onclick="likecomm(<?=$com->id;?>)" class="glyphicon glyphicon-triangle-top like_plus" aria-hidden="true"></span><span class="count_likes count_likes<?=$com->id;?>"> <?=$com->likes;?> </span><span onclick="dislikecomm(<?=$com->id;?>)" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } }?>
    <div class="add_comment" id="add-review">
        <?php if(Yii::$app->user->isGuest){?>
        <p class="add_title">Довольны работой компании или разочарованы? Оставьте свой отзыв!<br /></p><p class="add_title">Войти через:<br class="mobbr"/> <a href="<?=$fbhref;?>" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="<?=$vkhref?>" class="vk" data-pjax="0"><i class="fa fa-vk" aria-hidden="true"></i></a></p></p>
        <?php } else {?>
        <?=Html::a('Выйти', Url::to(['main/logout', 'alias'=>$alias], true), ['data-pjax'=>0, 'class'=> 'add_comment_logout']);?>        
        <p class="add_review">Добавить отзыв</p>
        <?php $f=ActiveForm::begin(['options'=>['data-pjax'=>true]]);?>
            <div class="row">
                <div class="star_input row">
                        <div class="col-md-3 col-sm-3 col-xs-3 review_mark">
                            <span>Ваша оценка:</span>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            
                            <?php 
                            echo StarRating::widget(['model' => $model, 'attribute' => 'star', 
                                'pluginOptions' => [
                                    'size'=>'xs',
                                    'step'=>1,
                                    'showClear' => false,
                                    'showCaption' => false
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                <div class="col-md-12">
                    <?=$f->field($model, 'text')->textArea(['placeholder'=>'Напишите здесь Ваше мнение о компании...', 'class'=>'review_text'])->label('');?>
                </div>
                <div class="col-md-12">
                    <div class="rew_bott">
                        <div class="review_button">
                            <?= Html::submitButton('Добавить', ['name' => 'add-button']) ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php ActiveForm::end();?>
        <?php }?>          
    </div>
</div>
<?php Pjax::end();?>
<div class="container recomend" id="recomend">
    <div class="pod_title">
        <p class="ne_podhodit">Не подходит данный вариант? Посмотрите популярные предложения</p>
        <img src="/frontend/web/img/lend_title.png" alt="Отзывы"/>
    </div>
    <div class="row">
        <?php foreach($rec as $r){ ?>
        <div class="col-md-12 col-lg-4 col-sm-12 col-xs-12">
            <div class="recblock">
                <img class="imgbl" src="/frontend/web/img/recblock.png" alt=""/>
                <table>
                    <tr>
                        <td colspan="2">
                            <div class="recimg">
                                <img class="logo_comp_rec" src="/frontend/web/img/<?= $r->img;?>"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="name_stars">
                            <a href="<?=Url::toRoute(['main/company', 'alias' =>$r->alias]);?>" class="title"><?= $r->name;?></a>
                            <div>
                            <?php for($i=0; $i<$r->stars;$i++) { ?>
                            <i class="fa fa-star star_full" aria-hidden="true"></i>
                            <?php } ?>
                            <?php for($i=0; $i<5 - $r->stars;$i++) { ?>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="sumsrok">
                            <p>Сумма, (руб)</p>
                            <p>Срок, (дн)</p>
                        </td>
                        <td class="sumsrokval">
                            <p>до <?= $r->max_sum;?> руб</p>
                            <p><?= $r->termin;?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="desc">
                            <p><?= $r->lit_desc;?></p>
                        </td>
                    </tr>
                </table>
                <?php if($r->checked){ ?>
                <img class="status_img" src="/frontend/web/img/status_img.png" />
                <?php } ?>
                <div class="findk">
                    <a target="_blank" data-id="<?=$r->id;?>" class="getcredit" href="#">Получить кредит</a>
                </div> 
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php
$urllink=Url::toRoute('main/link');
$script = <<< JS
    $(document).ready(function(){
        $(".getcredit").each( function ololo() {
              var d;
              var id=$(this).attr('data-id');
              var obj=$(this);
              $.get('$urllink', {id : id}, function(data){
                   obj.attr('href', data);
              });
        });
    });
JS;
$this->registerJs($script);
?>

<?php if ($this->beginCache("wall".$company->id, ['duration' => $data])) { ?>
<?php if($wall || $fb_wall){
    function to_link($string){ 
        return preg_replace("~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|$)~", '<a target="_blank" rel="nofollow" href="$1://$2">$1://$2</a>$3',$string); 
    } 
?>
<?php if($wall){?>
<div class="container wall">
    <hr />
    <div class="row">
        <h2>Новости от <?=$company->name;?></h2>
        <?php 
          for ($i = 1; $i < count($wall); $i++) 
          {?>
        <div class="col-sm-12">
            <div class="panel panel-info">
              <div class="panel-body">
                <div class="wall_text">
                    <?=to_link($wall[$i]->text);?>
                </div>
                <div class="row photos">
                    <?php 
                        $imgs=$wall[$i]->attachments;
                        //print_r($imgs);
                        $arr=[];
                        //$arrv=[];
                        for($j=0;$j<count($imgs);$j++){
                            if($imgs[$j]->photo->src) $arr[]='<img src="'.$imgs[$j]->photo->src_big.'" alt="'.$i.$j.'"/>';
                            //https://vk.com/club14475242?z=video-14475242_456239021
                            //if($imgs[$j]->video->vid) $arrv[]='<video><source src="https://vk.com/club'.substr($imgs[$j]->video->owner_id, 1).'?z=video'.$imgs[$j]->video->owner_id.'_'.$imgs[$j]->video->vid.'"></video>';
                        }
                        $col=count($arr);
                        if($col>=4) $col=3; else if($col==1) $col=12; else if ($col==3) $col=4; else if ($col==2) $col=6;
                        for($j=0;$j<count($arr);$j++){?>
                        <div class="col-md-<?=$col;?>">
                            <?=$arr[$j];?>
                        </div>
                        <?php }?>
                </div>
              </div>
              <div class="panel-footer">
                <?=date("d.m.Y",$wall[$i]->date);?>
              </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<?php }?>
<?php if($fb_wall){?>
<div class="container wall">
    <hr />
    <div class="row">
        <h2>Новости от <?=$company->name;?></h2>
        <?php 
          for ($i = 0; $i < count($fb_wall); $i++) 
          { if($fb_wall[$i]->message){?>
        <div class="col-sm-12">
            <div class="panel panel-info">
              <div class="panel-body">
                <div class="wall_text">
                    <?=to_link($fb_wall[$i]->message);?>
                </div>
              </div>
              <div class="panel-footer">
                <?php echo date("d.m.Y", strtotime($fb_wall[$i]->created_time));?>
              </div>
            </div>
        </div>
        <?php } }?>
    </div>
</div>
<?php }?>
<?php }?>
<?php  $this->endCache();
} ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel" style="font-size: 18px;">Ошибка</p>
      </div>
      <div class="modal-body">
        <p style="text-align: center;">Что бы оценить отзыв, нужно авторизоваться</p>
      </div>
    </div>
  </div>
</div>
<div id="totop">
    <img src="/frontend/web/img/totop.png"/>
</div>