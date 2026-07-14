<?php
$metodo='POST';
$db=require_once('../../includes/backend.php');

db_delete_by_id($db, 'usuarios', $_REQUEST['id']);
header('Location: .');