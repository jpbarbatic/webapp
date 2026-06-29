<?php
require_once('../../includes/backend.php');

if(!$_SERVER['REQUEST_METHOD']=='GET' or !isset($db)){
    die();
}

db_delete_by_id($db, 'usuarios', $_REQUEST['id']);
header('Location: .');