<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Theme;
$theme=Theme::find()->where(['id'=>1])->one();
$this->title = $theme->seo_title_vse;
$this->registerMetaTag([ 
    'name'=>'description', 
    'content'=>$theme->seo_desc_vse
]); 
$this->registerMetaTag([ 
    'name'=>'keywords', 
    'content'=>$theme->seo_keys_vse
]);
?>
<div class="container landing">
    <div class="lan_title">
        <h1>Все компании</h1>
        <img src="/frontend/web/img/lend_title.png" alt="<?= $page->h1;?>" />
    </div>
<?php Pjax::begin(['id'=>'pjax-landing','enablePushState' => false, 'scrollTo'=>300]);?>
    <?php if($companies) { ?>
    <div class="row filters_l1">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="sort">
                <div class="sort_left">
                    <p><img src="/frontend/web/img/filters.png" alt=">" />Сортировать по:</p>
                </div>
                <noindex>
                <div class="sort_right">
                    <a rel="nofollow" <?php $ss='DESC'; if($sortby=='max_sum' && $sort=='DESC') {echo 'class="active"'; $ss='ASC';} else if($sortby=='max_sum' && $sort=='ASC') echo 'class="active_rev"'; ?> href="<?=Url::current(['sortby'=>'max_sum', 'sort'=>$ss]);?>">Сумме кредита</a>
                    <a rel="nofollow" <?php $ts='DESC'; if($sortby=='max_termin' && $sort=='DESC') {echo 'class="active"'; $ts='ASC';} else if($sortby=='max_termin' && $sort=='ASC') echo 'class="active_rev"'; ?> href="<?=Url::current(['sortby'=>'max_termin', 'sort'=>$ts]);?>">Сроку</a>
                    <a rel="nofollow" <?php $rs='DESC'; if($sortby=='raiting' && $sort=='DESC') {echo 'class="active"'; $rs='ASC';} else if($sortby=='raiting' && $sort=='ASC') echo 'class="active_rev"'; ?> href="<?=Url::current(['sortby'=>'raiting', 'sort'=>$rs]);?>">Рейтингу</a>
                </div>
                </noindex>
                <div class="clearfix"></div>
            </div>        
        </div>
    </div>
    <?php }?>
    <div class="row filters_l2">
        <div class="col-md-7">
            <div class="payment">
                <div class="payment_left">                   
                    <p><img src="/frontend/web/img/filters.png" alt=">" />Выплаты на:</p>
                </div>
                <noindex>
                <div class="payment_right">
                        <a rel="nofollow" <?php if(!$pay){?>class="active" <?php }?> href="<?=Url::current(['pay'=>'']);?>">Все</a>
                        <a rel="nofollow" <?php if(strpos($pay, '1')!==false){?> class="active" href="<?=Url::current(['pay'=>str_replace("1-", "", $pay)]);?>" <?php } else {?> href="<?=Url::current(['pay'=>$pay.'1-']);?>" <?php }?> ><img src="/frontend/web/img/pay_card.png" alt="Карта" /></a>
                        <a rel="nofollow" <?php if(strpos($pay, '2')!==false){?> class="active" href="<?=Url::current(['pay'=>str_replace("2-", "", $pay)]);?>" <?php } else {?> href="<?=Url::current(['pay'=>$pay.'2-']);?>" <?php }?>><img src="/frontend/web/img/pay_money.png" alt="Деньги" /></a>
                        <a rel="nofollow" <?php if(strpos($pay, '3')!==false){?> class="active" href="<?=Url::current(['pay'=>str_replace("3-", "", $pay)]);?>" <?php } else {?> href="<?=Url::current(['pay'=>$pay.'3-']);?>" <?php }?>><img src="/frontend/web/img/pay_home.png" alt="Дом" /></a>
                        <a rel="nofollow" <?php if(strpos($pay, '4')!==false){?> class="active" href="<?=Url::current(['pay'=>str_replace("4-", "", $pay)]);?>" <?php } else {?> href="<?=Url::current(['pay'=>$pay.'4-']);?>" <?php }?>><img src="/frontend/web/img/pay_wallet.png" alt="Кошелек" /></a>
                </div>
                </noindex>
                <div class="clearfix"></div>
            </div>        
        </div>
        <div class="col-md-5">
            <div class="age">
                <div class="age_left">
                    <p>Мой возраст:</p>
                </div>
                <div class="age_right">
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if($old=='') echo 'Не важно'; else if($old==1) echo '18-19 лет'; else if($old==2) echo '20 лет'; else if($old==3) echo '21 год и более'; ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu">
                             <?php if($old!=''){?><li><noindex><a rel="nofollow" href="<?=Url::current(['ids'=>$ids,'old'=>'']);?>">Не важно</a></noindex></li><?php }?>
                             <?php if($old!=1){?><li><noindex><a rel="nofollow" href="<?=Url::current(['ids'=>$ids,'old'=>1]);?>">18-19 лет</a></noindex></li><?php }?>
                             <?php if($old!=2){?><li><noindex><a rel="nofollow" href="<?=Url::current(['ids'=>$ids,'old'=>2]);?>">20 лет</a></noindex></li><?php }?>
                             <?php if($old!=3){?><li><noindex><a rel="nofollow" href="<?=Url::current(['old'=>3]);?>">21 год и более</a></noindex></li><?php }?>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>     
        </div>
    </div>
<div class="company_list"> 
    <?php if($companies) {  foreach($companies as $comp){ ?>
    <div class="company">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="company_bg">
                    <div class="company_block">
                    <?php if($comp->checked) { ?>
                    <img class="proveren" src="/frontend/web/img/proveren.png" alt="Проверено" />
                    <?php } ?> 
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <a href="<?=Url::toRoute(['main/company', 'alias' =>$comp->alias]);?>"><p class="company_name"><?= $comp->name;?></p></a>
                                    <div class="company_stars">
                                        <?php for($i=0; $i<$comp->stars;$i++) { ?>
                                        <i class="fa fa-star star_full" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php for($i=0; $i<5 - $comp->stars;$i++) { ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php } ?>
                                    </div>
                                    <a href="<?=Url::toRoute(['main/company', 'alias' =>$comp->alias]);?>"><img class="company_logo" src="/frontend/web/img/<?= $comp->img;?>" alt="<?=$comp->name;?>"/></a>
                                </div>
                                
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="info_line">
                                        <p class="il_left">Сумма до</p>
                                        <div class="il_right">
                                            <p><?= $comp->max_sum;?> р</p>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Срок до</p>
                                        <div class="il_right">
                                            <p><?= $comp->termin;?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Рассмотрение</p>
                                        <div class="il_right">
                                            <p><?= $comp->watch;?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="info_line">
                                        <p class="il_left">Выплата на</p>
                                        <?php if(strpos($comp->pay, "1") !== false) {?>
                                            <img src="/frontend/web/img/pay_card.png" alt="Карта" />
                                        <?php } ?>
                                        <?php if(strpos($comp->pay, "2") !== false) {?>
                                            <img src="/frontend/web/img/pay_money.png" alt="Наличные" />
                                        <?php } ?>
                                        <?php if(strpos($comp->pay, "3") !== false) {?>
                                            <img src="/frontend/web/img/pay_home.png" alt="Дом" />
                                        <?php } ?>
                                        <?php if(strpos($comp->pay, "4") !== false) {?>
                                            <img src="/frontend/web/img/pay_wallet.png" alt="Яндекс.Деньги" />
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <a href="<?= $comp->href;?>" data-id="<?=$comp->id;?>" class="getcredit<?php if(!$comp->href) { echo " disabled";} ?>">
                                        <div class="button_bg">
                                            <div class="button">
                                                Оформить займ
                                            </div>
                                        </div>
                                    </a>
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <?php } } else {?>
    <div class="company">
        <div class="row">
            <h4 class="nocompanies">По таким условиям кредитных предложений нет, измените условия поиска.</h4>
        </div>
    </div> 
    <?php }?>
</div>
<?php Pjax::end();?>
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
</div>