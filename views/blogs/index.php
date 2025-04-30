<?php
$blogs = getBlogs();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-4">Your Posts</h1>
        <a href="index.php?page=create" class="btn btn-outline-primary mb-3">Add New Post</a>
    </div>

    <?php if (!empty($blogs)): ?>
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <th scope="row"><?= $blog['id'] ?></th>
                    <td><?= htmlspecialchars($blog['title']) ?></td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <?= strlen($blog['content']) > 50 ? htmlspecialchars(substr($blog['content'], 0, 50)) . '...' : htmlspecialchars($blog['content']) ?>

                    </td>
                    <td><img width="50" src="<?= "{$_SERVER['REQUEST_SCHEME']}://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $blog['image'] ?>"></td>
                    <td>
                        <a href="index.php?page=view_blog&action=view&id=<?=$blog['id']?>" class="btn btn-outline-info btn-sm">View</a>
                        <a href="index.php?page=edit_blog&action=edit&id=<?=$blog['id']?>" class="btn btn-outline-warning btn-sm">Edit</a>
                        <form method="POST" action="index.php?page=delete_blog&action=delete" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            <input type="hidden" name="id" value="<?=$blog['id']?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="alert alert-dark text-center">No Posts Available</div>
    <?php endif; ?>
</div>

  

