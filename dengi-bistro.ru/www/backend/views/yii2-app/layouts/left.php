<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => 'Компании', 'icon' => 'fa fa-list-alt', 'url' => ['/company']],
                    ['label' => 'Верхнее меню', 'icon' => 'fa fa-list-alt', 'url' => ['/topmenu']],
                    ['label' => 'Нижнее меню', 'icon' => 'fa fa-list-alt', 'url' => ['/bottommenu']],
                    ['label' => 'Меню в подвале', 'icon' => 'fa fa-list-alt', 'url' => ['/footermenu']],
                    ['label' => 'Страницы', 'icon' => 'fa fa-list-alt', 'url' => ['/page']],
                    ['label' => 'Офферы', 'icon' => 'fa fa-list-alt', 'url' => ['/offer']],
                    ['label' => 'Популярные предложения', 'icon' => 'fa fa-list-alt', 'url' => ['/reccompany/view?id=1']],
                    ['label' => 'Полезные статьи', 'icon' => 'fa fa-list-alt', 'url' => ['/recarticle/view?id=1']],
                    ['label' => 'Отзывы', 'icon' => 'fa fa-list-alt', 'url' => ['/review']],
                    ['label' => 'Настройки + СЕО', 'icon' => 'fa fa-list-alt', 'url' => ['/theme/view?id=1']],
                    //['label' => 'Настройки + СЕО', 'icon' => 'fa fa-tags', 'url' => ['/theme/view']],
                    //['label' => 'Отзывы', 'icon' => 'fa fa-tags', 'url' => ['/review']],
                    //['label' => 'Страницы', 'icon' => 'fa fa-tags', 'url' => ['/pages']],
                    //['label' => 'Таблицы на глвной', 'icon' => 'fa fa-tags', 'url' => ['/mainpage/view']],
                ],
            ]
        ) ?>

    </section>

</aside>
