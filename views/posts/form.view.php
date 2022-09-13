<?php

$id = $postData['id'] ?? '';
$title = $postData['title'] ?? '';
$description = $postData['details'] ?? '';
$author = $postData['author'] ?? '';

?>


<form method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <input type="text" name="id" hidden value="<?php echo $id; ?>" class="form-control">
    </div>


    <div class="mb-3">
        <label style="color: #405e48;">Title</label>
        <input type="text" name="title" placeholder="Enter Title" value="<?php echo $title; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label style="color: #405e48;">List Description</label>
        <textarea type="text" name="description" placeholder="Description" class="form-control" required><?php echo $description; ?></textarea>
    </div>
    <div class="mb-3">
        <label style="color: #405e48;">Author</label>
        <input type="text" name="author" value="<?php echo $author; ?>" placeholder="Author Name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label style="color: #405e48;">Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>
    <div class="float-end">
        <button type="submit" class="btn btn-outline-success">
            <?php
            if ($action === 'edit') {
                echo "Update";
            } else {
                echo "Add List";
            }
            ?>
        </button>
    </div>
</form>