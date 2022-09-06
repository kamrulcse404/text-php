<?php

require_once __DIR__ .'./../config/database.php';
$errors = array();
$action = 'edit';
$pageTitle = 'Edit List';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // var_dump($id);
    // die('id not found');
    $postQuery = "SELECT * FROM todo_list WHERE id = :id";

    $stmt = $pdo->prepare($postQuery);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $postData = $stmt->fetch(PDO::FETCH_ASSOC); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    date_default_timezone_set('Asia/Dhaka');

    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $author = $_POST['author'] ?? null;
    $image = $_FILES['image'];
    $imagePath = '';
    if (!$title) {
        $errors['title'] = 'Title is required';
    }
    if (!$description) {
        $errors['description'] = 'Description is required';
    }
    if (!$author) {
        $errors['author'] = 'Author name is required';
    }

    if (!$errors) {

        if ($image) {
            if (!is_dir('images')) {
                mkdir('images');
            }
        
            if (!is_dir('images/todos')) {
                mkdir('images/todos');
            }
            
            $imagePath = 'images/todos/'. uniqid() .$image['name'];
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        $query = "INSERT INTO todo_list(title, details, author, created_at, image_path) VALUES(:title, :details, :author, :created_at, :image_path)";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':details', $description);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
        $stmt->bindValue(':image_path', $imagePath);
        $stmt->execute();

        header('Location: index.php');
    }
}

?>

<?php

ob_start();
require_once __DIR__ . './../views/posts/editList.view.php';

$content = ob_get_clean();
require_once __DIR__ . './../views/layout.view.php';

?>