<div class="col mt-4">
    <div class="card">
        <div class="card-header">
            <h5 style="color: #405e48;"><?php echo $heading; ?>
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
                            <td><img class="w-25" src="<?php echo 'assets/' . $list['image_path']; ?>" alt="Todo Image"></td>
                            <td>
                                <a href="editList.php?<?php echo $list['id']; ?>" class="btn btn-outline-primary">Edit</a>
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

<?php