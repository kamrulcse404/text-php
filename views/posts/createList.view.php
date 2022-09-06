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
            <h5 style="color: #405e48;"><?php echo $heading; ?>
                <a href="./index.php" class="btn btn-outline-primary float-end">Back To Lists</a>
            </h5>
        </div>
        <div class="card-body">
            <?php require_once __DIR__ . '/form.view.php'; ?>
        </div>
    </div>
</div>