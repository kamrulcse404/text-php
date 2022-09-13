<?php

require_once __DIR__ . './../app/Controllers/ListsController.php';
use App\Controllers\ListsControllers;

$errors = array();
$action = 'create';
$pageTitle = "Create List";
$heading = 'Add List';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $createInstance = new ListsControllers();
    $createInstance->store($_POST);
}

?>
<?php 
ob_start();
require_once __DIR__ . './../views/posts/createList.view.php';

$content = ob_get_clean();
require_once __DIR__ . './../views/layout.view.php';

?>
