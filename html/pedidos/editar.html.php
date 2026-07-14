<h2><?= $titulo ?></h2>
<?php include 'formulario.html.php' ?>

<table class="table">
    <thead>
        <th>Artículo</th>
        <th>Precio compra</th>
        <th>Unidades</th>
        <th>Total</th>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach ($lineas_pedido as $linea): ?>
            <tr>
                <td><?= $linea['nombre'] ?></td>
                <td><?= $linea['importe'] ?></td>
                <td><?= $linea['cantidad'] ?></td>
                <td><?= $linea['importe']*$linea['cantidad'] ?></td>
            </tr>
        <?php $total+=$linea['importe']*$linea['cantidad']?>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><?= $total ?></td>
        </tr>
    </tbody>
</table>