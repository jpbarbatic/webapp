<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <base href="<?= URL_BASE ?>">

    <title><?= NOMBRE_WEB ?><?php echo isset($titulo) ? ' - ' . $titulo : '' ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbar-fixed/">

    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        tr {
            vertical-align: middle;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/dashboard.css" rel="stylesheet">
    <?php if (file_exists(__DIR__.'/'.$vista . ".css.php")) {
        include __DIR__.'/'.$vista . ".css.php";
    } ?>
</head>

<body>

    <?php include "nav.html.php" ?>
    <main class="container">
        <?php if (isset($_SESSION['mensaje']['ok'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje']['ok'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['mensaje']['ko'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje']['ko'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <?php if (file_exists(__DIR__.'/'.$vista . ".html.php")) {
        include __DIR__.'/'.$vista . ".html.php";
    } ?>
    </main>

    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__.'/comun.script.php'; ?>
    <?php if (file_exists(__DIR__.'/'.$vista . ".script.php")) {
        include __DIR__.'/'.$vista . ".script.php";
    } ?>
</body>
</html>
<?php unset($_SESSION['mensaje']);?>
