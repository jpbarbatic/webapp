<html>

<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: lightgray;
        }

        td,
        th {
            border: 1px solid black;
        }

        tr {
            height: 50px;
        }

        .id {
            text-align: center;
        }

        .numero {
            text-align: right;
        }

        @page {
            margin: 15mm 15mm 25mm 15mm;

            /* Bottom aumentado para que quepa el texto */
            @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-family: Arial, Helvetica, sans-serif;
                font-size: 9pt;
                color: #333;
            }
        }
    </style>
</head>

<body>
    <h1>Listado de usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
            </tr>
        </thead>
        <?php $num_registros = 0;
        $max_registros = 1000;
        $res = db_select($db, $sql, $params, $max_registros, 0, $orden, $orden_dir);
        extract($res);
        while (true): $productos = $datos; ?>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td class="id"><?= $producto['id'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td class="numero"><?= $producto['stock'] ?></td>
                    <td class="numero"><?= $producto['precio'] ?>€</td>
                </tr>
            <?php endforeach; ?>
            <?php
            $num_registros = $num_registros + count($productos);
            if ($num_registros < $total) {
                $res = db_select($db, $sql, $params, $max_registros, $num_registros, $orden, $orden_dir);
                extract($res);
            } else {
                break;
            }
            ?>
        <?php endwhile; ?>
    </table>
</body>

</html>