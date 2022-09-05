<?php

$errors = array();
require_once './database.php';

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add Todo List</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="./">Todo</a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Main -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-8 mt-1">
                <div class="card mt-1">
                    <?php if ($errors) : ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="card-header">
                        <h5 style="color: #405e48;">Add List
                            <a href="./index.php" class="btn btn-outline-primary float-end">Back To Lists</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php require_once './form.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main End -->

    <!-- Footer -->
    <div class="container-fluid position-absolute position-fixed bottom-0 ">
        <div class="row">
            <footer class="text-center bg-dark">
                <div class="text-center p-1 text-muted">
                    © 2022 Copyright: Md Kamrul Hasan
                </div>
            </footer>
        </div>
    </div>
    <!-- Footer End -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>