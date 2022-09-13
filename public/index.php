<?php

// require_once __DIR__ . '/../app/Controllers/ListsController.php';
require_once __DIR__ . "./../vendor/autoload.php";

use App\Controllers\ListsControllers;

$pageTitle = "Todo Blog";
$heading = 'All Lists';

$listsInstance = new ListsControllers();
$lists = $listsInstance->index();

?>

<?php
ob_start();
require_once __DIR__ . './../views/posts/index.view.php';

$content = ob_get_clean();

require_once __DIR__ . './../views/layout.view.php';

?>