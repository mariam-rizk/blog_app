<?php
$blogs = getAllBlogs();
?>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

        <?php if(!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <!-- Post preview-->
                <div class="post-preview mb-5">
                    <a href="#">
                        <h2 class="post-title"><?= htmlspecialchars($blog['title']) ?></h2>
                        <h3 class="post-subtitle"><?= strlen($blog['content']) > 100 ? htmlspecialchars(substr($blog['content'], 0, 100)) . '...' : htmlspecialchars($blog['content']) ?></h3>
                        <?= strlen($blog['content']) > 50 ? htmlspecialchars(substr($blog['content'], 0, 50)) . '...' : htmlspecialchars($blog['content']) ?>
                    </a>
                    <p class="post-meta">
                        Posted by <a href="#"><?= htmlspecialchars($blog['name']) ?></a>
                        on <?= htmlspecialchars($blog['created_at']) ?>
                    </p>
                </div>
                <hr class="my-4" />
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-dark text-center">No posts available</div>
        <?php endif; ?>

        </div>
    </div>
</div>



    