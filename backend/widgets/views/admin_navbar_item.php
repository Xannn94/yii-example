<?php
use backend\widgets\AdminNavBar;
/**
 * @var AdminNavBar $adminMenu
 */
?>
<li class="nav-item has-treeview <?php if($adminMenu->isCurrentGroup()): ?> menu-open <?php endif; ?>">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
            <?= $data['title'] ?>
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <?php foreach ($data['items'] as $key => $item): ?>
            <li class="nav-item active">
                <a href="<?= $item['url']?>" class="nav-link <?php if ($adminMenu->isCurrentItem($item['url'])):?> active <?php endif; ?>">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p><?= $item['title']?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</li>