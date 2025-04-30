<div class="container mt-5">
    <div class="row justify-content-center">
        <?php
        if ($_GET['action'] == "view" && isset($_GET['id'])) {
            $id = $_GET['id'];
            $blog = findBlog($id);
        }
        ?>
 
        <div class="card" style="width: 18rem;">
        <img src="<?= "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $blog['image'] ?>" class="card-img-top" >
        <div class="card-body">
    
          <h2 class="post-title"><?= $blog['title'] ?></h2>
          <p class="post-subtitle"><?= $blog['content'] ?></p>
        
          <h6 class="post-meta">Posted on <?= ($blog['created_at']) ?></h6>
          <a href="index.php?page=blogs" class="btn btn-primary">Go Back</a>
        </div>
        </div>