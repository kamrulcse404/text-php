<?php

// require_once __DIR__ . './../app/Controllers/ListsController.php';
require_once __DIR__ . './../vendor/autoload.php';
use App\Controllers\ListsController;

$errors = array();
$action = 'create';
$pageTitle = "Create List";
$heading = 'Add List';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $createInstance = new ListsController();
    $createInstance->store($_POST);
}

?>
<?php 
ob_start();
require_once __DIR__ . './../views/posts/createList.view.php';

$content = ob_get_clean();
require_once __DIR__ . './../views/layout.view.php';

?>
