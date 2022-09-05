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

            $imagePath = 'images/todos/' . uniqid() . $image['name'];
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

<?php require_once './partials/header.php'; ?>

<!-- Navbar -->
<?php require_once './partials/nav.php'; ?>
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
<?php require_once './partials/footer.php'; ?>
<!-- Footer End-->