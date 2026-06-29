<?php
$db = require_once('../../includes/backend.php');
$noticias = @simplexml_load_file('https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/ultimas-noticias/portada');
$titulo='Dashboard';
$vista='dashboard/dashboard';
require('../../html/plantilla.html.php');