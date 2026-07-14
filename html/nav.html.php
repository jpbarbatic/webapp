    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL_BASE ?>"><?= NOMBRE_WEB?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link<?= str_starts_with($vista, 'dashboard') ? ' active':'' ?>" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <?php if(es_visible('usuarios')):?>
                    <li class="nav-item">
                        <a class="nav-link<?= str_starts_with($vista, 'usuarios') ? ' active':'' ?>" href="usuarios/">Usuarios</a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link<?= str_starts_with($vista, 'roles') ? ' active':'' ?>" href="roles/">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= str_starts_with($vista, 'productos') ? ' active':'' ?>" href="productos/">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= str_starts_with($vista, 'categorias') ? ' active':'' ?>" href="categorias/">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= str_starts_with($vista, 'pedidos') ? ' active':'' ?>" href="pedidos/">Pedidos <span id="num_pedidos" class="badge text-bg-danger"></span></a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Salir</a>
                    </li>                    
                </ul>
            </div>
        </div>
    </nav>
