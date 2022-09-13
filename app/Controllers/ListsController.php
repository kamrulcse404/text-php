<?php

namespace App\Controllers;

// require_once __DIR__ . './../Helpers/Database.php';
// require_once __DIR__ . "./../../vendor/autoload.php";

use PDO;
use App\Helpers\Database;

class ListsControllers
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function index()
    {
        try {
            $query = "SELECT * FROM todo_list ORDER BY id DESC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            die("Can not query to DB");
        }
    }

    public function edit($response)
    {
        $id = $response['id'];
        $postQuery = "SELECT * FROM todo_list WHERE id = :id";

        $stmt = $this->pdo->prepare($postQuery);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateList($request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $id = $request['id'] ?? null;
        $title = $request['title'] ?? null;
        $description = $request['description'] ?? null;
        $author = $request['author'] ?? null;

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

            // if ($image) {
            //     if (!is_dir('images')) {
            //         mkdir('images');
            //     }

            //     if (!is_dir('images/todos')) {
            //         mkdir('images/todos');
            //     }

            //     $imagePath = 'images/todos/' . uniqid() . $image['name'];
            //     move_uploaded_file($image['tmp_name'], $imagePath);
            // }

            $imagePath = 'images/todos/' . uniqid() . $image['name'];
            move_uploaded_file($image['tmp_name'], $imagePath);

            // var_dump($title);
            // echo "<br>";
            // var_dump($description);
            // echo "<br>";
            // var_dump($author);
            // echo "<br>";
            // var_dump($id);
            // echo "<br>";
            // exit;


            $query = "UPDATE todo_list SET title = :title, details = :details, author = :author, created_at = :created_at, image_path = :image_path WHERE id = :id";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':details', $description);
            $stmt->bindValue(':author', $author);
            $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
            $stmt->bindValue(':image_path', $imagePath);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // var_dump($stmt);exit;

            header('Location: index.php');
        }
    }

    public function store($request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $title = $request['title'] ?? null;
        $description = $request['description'] ?? null;
        $author = $request['author'] ?? null;
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

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':details', $description);
            $stmt->bindValue(':author', $author);
            $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
            $stmt->bindValue(':image_path', $imagePath);
            $stmt->execute();

            header('Location: index.php');
        }
    }
}
