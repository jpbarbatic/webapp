<a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Filtro
</a>
<div class="collapse<?= isset($_GET['filtro']) ? ' show' :'' ?> mt-3" id="collapseExample">
    <form action="">
        <div class="row">
            <div class="col-auto">
                <label class="col-form-label">Nombre/Id</label>
            </div>
            <div class="col-auto">
                <input class="form-control form-control-sm" name="filtro[nombre]" value="<?= isset($_GET['filtro']['nombre']) ? $_GET['filtro']['nombre'] : '' ?>">
            </div>
            <div class="col-auto">
                <select class="form-select form-select-sm" name="filtro[categoria]">
                    <option value=''>--Elige una categoría--</option>
                    <?= html_opciones($categorias, isset($_GET['filtro']['categoria']) ? $_GET['filtro']['categoria'] : '', 'id', 'nombre') ?>
                </select>
            </div>            
            <div class="col-auto">
                <input class="btn btn-primary btn-sm" type="submit" value="Buscar">
            </div>
        </div>
    </form>
</div>