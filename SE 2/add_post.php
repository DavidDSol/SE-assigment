<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/blog-post.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">



                <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">web assigment</a>

                            <a class="navbar-brand" href="post.php">Home page</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->


                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container -->
                </nav>
                <?php include  "functions.php"?>
                <?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count  = 4;
        move_uploaded_file($post_image_temp, "images/$post_image");
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";    
        $query .=  "VALUES({$post_category_id},'{$post_title}', '{$post_author}',now() , '{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}')";
        $create_post_query = mysqli_query($connection, $query);
        confrimQuery($create_post_query);
    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type = "text" class = "form-control" name="title">        
                    </div>
                    <div class="form-group">
                        <label for="post_category">Post Category Id</label>
                        <input type="text" class="form-control" name="post_category_id">
                    </div>
                    <div class="form-group">
                        <label for="title">Post Author</label>
                        <input type="text" class="form-control" name="author">
                    </div>
                    <div class="form-group">
                        <label for="post_status">Post Status</label>
                        <input type="text" class="form-control" name="post_status">
                    </div>
                    <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="post_tages">Post Tags</label>
                        <input type="text" class="form-control" name="post_tags">
                    </div>
                    <div class="form-group">
                        <label for="post_content">Post content</label>
                        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="create_post" value="PublishPost">
                    </div>
                </form>
            </div></div></div></div>
