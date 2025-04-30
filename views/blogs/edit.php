<?php
if ($_GET['action'] == "edit" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $blog = findBlog($id);
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mb-4">Edit Post</h1>
    </div>
    <form method="post" action="index.php?page=update_blog&action=update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $blog['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?=$blog['title']?>">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Images</label>
            <input type="file" class="form-control" name="image" id="image">
            <?php if (!empty($blog['image'])): ?>
                <div>
                    <small>Current Image</small>
                    <img width="30" src="<?= "{$_SERVER['REQUEST_SCHEME']}://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $blog['image'] ?>">
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content"><?=$blog['content']?></textarea>
        </div>
                <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>