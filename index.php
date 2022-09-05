<?php

require_once './database.php';

try {

  $query = "SELECT * FROM todo_list ORDER BY id ASC";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {

  die("Can not query to DB");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Todo</title>
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
  <div class="container-fluid mt-1">
    <div class="row">
      <div class="col mt-4">
        <div class="card">
          <div class="card-header">
            <h5 style="color: #405e48;">All Lists
              <a href="./createList.php" class="btn btn-outline-primary float-end">Add List</a>
            </h5>
          </div>
          <div class="card-body">
            <table class="table table-borderd table-striped">
              <thead>
                <tr>
                  <th style="color: #405e48;">Id</th>
                  <th style="color: #405e48;">Title</th>
                  <th style="color: #405e48;">Details</th>
                  <th style="color: #405e48;">Author</th>
                  <th style="color: #405e48;">Created Date</th>
                  <th style="color: #405e48;">Imgae</th>
                  <th style="color: #405e48;">Edit</th>
                  <th style="color: #405e48;">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lists as $list) : ?>
                  <tr>
                    <td><?php echo $list['id']; ?></td>
                    <td><?php echo $list['title']; ?></td>
                    <td><?php echo $list['details']; ?></td>
                    <td><?php echo $list['author']; ?></td>
                    <td><?php echo $list['created_at']; ?></td>
                    <td><img class="w-25" src="<?php echo $list['image_path']; ?>" alt="Todo Image"></td>
                    <td>
                      <a href="editList.php?<?php echo $list['id'];?>" class="btn btn-outline-primary">Edit</a>
                    </td>
                    <td>
                      <a href="" class="btn btn-outline-danger">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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