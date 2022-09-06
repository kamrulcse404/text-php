<?php

namespace app\Controllers;

require_once __DIR__ . './../Helpers/Database.php';

use PDO;
use app\Helpers\Database;

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
            $query = "SELECT * FROM todo_list ORDER BY id ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            // $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            die("Can not query to DB");
        }
    }

    public function edit()
    {
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
