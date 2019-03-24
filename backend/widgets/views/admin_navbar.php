<?php

use backend\widgets\AdminNavBar;
use yii\helpers\Html;

?>
<?php
/**
 * @var AdminNavBar $adminMenu
 */
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php if ($adminMenu->brandVisible): ?>
        <a href="<?= $adminMenu->brandUrl ?>" class="brand-link">
            <img src="/img/logo.png" alt="<?= $adminMenu->brandLabel ?>" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light"><?= $adminMenu->brandLabel ?></span>
        </a>
    <?php endif; ?>

    <div class="sidebar">
        <?php if ($adminMenu->userVisible): ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <?= Html::beginForm(['/site/logout'], 'post'); ?>
                    <?= Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    ); ?>
                    <?= Html::endForm(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php foreach ($adminMenu->getConfigMenu() as $key => $value): ?>
                    <?php if (isset($value['items'])): ?>
                        <?= $this->render('admin_navbar_item',[
                                'data' => $value,
                                'adminMenu' => $adminMenu
                        ]) ?>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= $value['url'] ?>"
                               class="nav-link <?php if ($adminMenu->isCurrentMain($value['url'])): ?> active <?php endif; ?>">
                                <i class="nav-icon fa fa-th"></i>
                                <p><?= $value['title'] ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
