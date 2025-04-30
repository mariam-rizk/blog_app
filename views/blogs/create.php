<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="mb-4">Create Post</h1>
    </div>
    <form method="post" action="index.php?page=add_blog&action=store" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Images</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" placeholder="Enter content"></textarea>
        </div>
                <div class="d-grid">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>