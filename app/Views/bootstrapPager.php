<?php
use CodeIgniter\Pager\PagerRenderer;
/** @var PagerRenderer */
$pager->setSurroundCount(2);
?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <li <?= ($pager->hasPreviousPage() ? 'class="page-item"' : 'class="page-item disabled"') ?>>
            <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="page-link">
                <span aria-hidden="true"><?= lang('Pager.first') ?></span>
            </a>
        </li>
        <li <?= ($pager->hasPreviousPage() ? 'class="page-item"' : 'class="page-item disabled"') ?>>
            <a href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
                <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
            </a>
        </li>
        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="page-item active"' : 'class="page-item"' ?>>
                <a href="<?= $link['uri'] ?>" class="page-link"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>
        <li <?= ($pager->hasNextPage() ? 'class="page-item"' : 'class="page-item disabled"') ?>>
            <a href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
                <span aria-hidden="true"><?= lang('Pager.next') ?></span>
            </a>
        </li>
        <li <?= ($pager->hasNextPage() ? 'class="page-item"' : 'class="page-item disabled"') ?>>
            <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
                <span aria-hidden="true"><?= lang('Pager.last') ?></span>
            </a>
    </li>
    </ul>
</nav>