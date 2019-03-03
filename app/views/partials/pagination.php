<?php if (isset($pagination)): ?>
    <div class="row my-2">
        <div class="col-md-12 text-right">
            <ul class="pagination">
                <?php if($pagination['prev']): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pagination['links'][ $pagination['prev'] ] ?>">
                            <i class="fa fa-angle-double-left"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <?php foreach ($pagination['links'] as $pageNum => $link): ?>
                    <?php if (($pageNum == $pagination['current']-2) and (($pagination['current']-2) > 2)): ?>
                        <li class="page-item <?= ($pageNum == $pagination['current']) ? 'active' : '' ?>">
                            <div class="page-link">...</div>
                        </li>
                    <?php endif; ?>

                    <?php if (
                            ($pagination['totalPages'] < 10) or
                            (
                                ($pageNum < 3) or ($pageNum > $pagination['totalPages']-2) or
                                (($pageNum > $pagination['current'] - 2) and ($pageNum < $pagination['current'] + 2))
                            )
                        ):  ?>
                            <li class="page-item <?= ($pageNum == $pagination['current']) ? 'active' : '' ?>">
                                <a class="page-link" href="<?= $link ?>"><?= $pageNum?></a>
                            </li>
                    <?php endif; ?>

                    <?php if (($pageNum == $pagination['current']+2) and ($pagination['current']+2 < $pagination['totalPages']-1)): ?>
                        <li class="page-item <?= ($pageNum == $pagination['current']) ? 'active' : '' ?>">
                            <div class="page-link">...</div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if($pagination['next']): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $pagination['links'][ $pagination['next'] ] ?>">
                            <i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
