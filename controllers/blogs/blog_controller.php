<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_GET['action']=="store"){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image'];
    
    $errors = validateAddBlog($title, $content, $image);

    if(!empty($errors)){
        setMessage("danger", $errors);
        header("location:index.php?page=create");
        exit;
    }
    if(addBlog($title, $content, $image)){
        setMessage("success", "Post added successfully");
        header("location:index.php?page=blogs");
        exit;

    }else{
        setMessage("danger", "Failed to add a new post");
        header("location:index.php?page=blogs");
        exit;

    }

    }elseif ($_GET['action'] == "delete" && isset($_POST['id'])) {
        $id = $_POST['id'];
        if (deleteBlog($id)) {
            setMessage("success", "Post Deleted Sucessfully");
            header("location: index.php?page=blogs");
            exit;
        } else {
            setMessage("danger", "Failed to delete");
            header("location: index.php?page=blogs");
            exit;
        }
    }elseif ($_GET['action'] == 'update' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image'];
        if (updateBlog($id, $title, $content, $image)) {
            setMessage("success", "Post updated sucessfully");
            header("location: index.php?page=blogs");
            exit;
        } else {
            setMessage("danger", "Failed to update");
            header("Location: index.php?page=edit_blog&id=" . $id);
            exit;
        }
    }

}