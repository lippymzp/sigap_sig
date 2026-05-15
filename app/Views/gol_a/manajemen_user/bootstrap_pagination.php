<?php if ($pager->hasPrevious() || $pager->hasNext()) : ?>

<nav>
    <ul class="pagination mb-0">

        <!-- Previous -->
        <?php if ($pager->hasPrevious()) : ?>

            <li class="page-item">
                <a class="page-link"
                   href="<?= $pager->getPreviousPageURI() ?>">
                    Previous
                </a>
            </li>

        <?php else : ?>

            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>

        <?php endif ?>

        <!-- Nomor Halaman -->
        <?php foreach ($pager->links() as $link) : ?>

            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">

                <?php if ($link['active']) : ?>

                    <span class="page-link">
                        <?= $link['title'] ?>
                    </span>

                <?php else : ?>

                    <a class="page-link"
                       href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>

                <?php endif ?>

            </li>

        <?php endforeach ?>

        <!-- Next -->
        <?php if ($pager->hasNext()) : ?>

            <li class="page-item">
                <a class="page-link"
                   href="<?= $pager->getNextPageURI() ?>">
                    Next
                </a>
            </li>

        <?php else : ?>

            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>

        <?php endif ?>

    </ul>
</nav>
<?php endif ?>