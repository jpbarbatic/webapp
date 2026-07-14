<form action="pedidos/guardar.php" method="post">
    <div class="row">
        <div class="col-md-1">
            <label>ID</label>
            <input readonly class="form-control" name="id" value="<?php echo isset($pedido) ? $pedido['id'] : '' ?>">
        </div>
        <div class="col-md-3">
            <label>Fecha</label>
            <input class="form-control" type="datetime" name="fecha" value="<?php echo isset($pedido) ? $pedido['fecha'] : '' ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>Nombre y apellidos</label>
            <input class="form-control" type="" name="nombre_apellidos" value="<?php echo isset($pedido) ? $pedido['nombre_apellidos'] : '' ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>Dirección</label>
            <input class="form-control" type="" name="direccion_envio" value="<?php echo isset($pedido) ? $pedido['direccion_envio'] : '' ?>">
        </div>
        <div class="col-md-4">
            <label>Población</label>
            <input class="form-control" type="" name="poblacion_envio" value="<?php echo isset($pedido) ? $pedido['poblacion_envio'] : '' ?>">
        </div>
        <div class="col-md-4">
            <label>C. Postal</label>
            <input class="form-control" type="" name="cp_envio" value="<?php echo isset($pedido) ? $pedido['cp_envio'] : '' ?>">
        </div>         
        <div class="col-md-4">
            <label>Provincia</label>
            <input class="form-control" type="" name="provincia_envio" value="<?php echo isset($pedido) ? $pedido['provincia_envio'] : '' ?>">
        </div>        
    </div>

</form>
<form>
    <div class="row">
        <div class="col-md-3">
            <label>Estado</label>
            <select clasS="form-select" name="estado">
                <?= html_opciones($estados_pedidos, $pedido['estado']) ?>
            </select>
        </div> 
        <div class="col-md-3 mt-4">
            <button class="btn btn-primary">Cambiar estado</button>
        </div>               
    </div>
    </div>
</form>