<?php
// var_dump('Index');
// require_once __DIR__.'./../config/database.php';
// require_once __DIR__ . '/../app/Helpers/Database.php';
require_once __DIR__ . '/../app/Controllers/ListsController.php';

use app\Controllers\ListsControllers;
// use app\Helpers\Database;

// $pdo = Database::getInstance();


$pageTitle = "Todo Blog";
$heading = 'All Lists';

$listsInstance = new ListsControllers();
$lists = $listsInstance->index();

// try {
//   $query = "SELECT * FROM todo_list ORDER BY id ASC";
//   $stmt = $pdo->prepare($query);
//   $stmt->execute();
//   $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (\Throwable $th) {
//   die("Can not query to DB");
// }

?>

<?php
ob_start();
require_once __DIR__ . './../views/posts/index.view.php';

$content = ob_get_clean();

require_once __DIR__ . './../views/layout.view.php';

?>