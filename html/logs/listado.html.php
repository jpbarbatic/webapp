<table class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>IP</th>
            <th>Info</th>
        </tr>
    </thead>
    <?php foreach ($logs as $log): ?>
        <?php $campos = explode(' - ', $log); ?>
        <tbody>
            <tr>
                <td><?= $campos[0] ?></td>
                <td><?= $campos[1] ?></td>
                <td><?= $campos[2] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
</table>