<?php $num_paginas = ceil($total / $items_pagina); ?>
<?php if ($num_paginas > 1): ?>
    <ul class="pagination pagination-sm">
        <li class="page-item<?= $p == 1 ? ' disabled' : '' ?>">
            <a class="page-link" href="<?= strstr($vista, '/', true) ?>/?p=<?= $p - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_paginas; $i++): ?>
            <li class="page-item<?= $p == $i ? ' active' : '' ?>"><a class="page-link" href="<?= strstr($vista, '/', true) ?>/?p=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item<?= $p == $num_paginas ? ' disabled' : '' ?>">
            <a class="page-link" href="<?= strstr($vista, '/', true) ?>/?p=<?= $p + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
<?php endif; ?>