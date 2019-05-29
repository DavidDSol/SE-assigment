<?php 

include "functions.php"

?>




<?php
    $mes = "";
if (isset($_POST['btn-sent'])) {
    function genid(){
        return sprintf( '%04x%04x-%04x-%04x',
                       mt_rand( 0, 0xff6f ), mt_rand( 0, 0xffff ),
                       mt_rand( 0, 0xfffa ),
                       mt_rand( 0, 0xFC2f ) | 0x5000
                      );
    }
    $gen_id = genid();
    $fn = @mysqli_real_escape_string($connection,$_POST['fn']);
    $ln = @mysqli_real_escape_string($connection,$_POST['ln']);
    $age = @mysqli_real_escape_string($connection,$_POST['age']);
    $pass = @mysqli_real_escape_string($connection,$_POST['pass']);
    $repass = @mysqli_real_escape_string($connection,$_POST['repass']);
    $gender = @mysqli_real_escape_string($connection,$_POST['gender']);
    if ($pass == $repass){
        if($rej  = @mysqli_query($connection,"INSERT INTO users (gen_id,firstname,lastname,age,password,gender) VALUES('$gen_id','$fn','$ln','$age','$repass','$gender')")){
            $mes = "<span style=\"color:green;font-family: Georgia;margin-bottom: 20px;\">User added successfully!</span>";
        }
        else{
            $mes = "<span style=\"color:red;font-family: Georgia;margin-bottom: 20px;\">Oop's something is Wrong!</span>";
        }
    }
    else{
        $mes = "<span style=\"color:red;font-family: Georgia;margin-bottom: 20px;\">Password and retype password doesn't match!</span>";
    }
}

?>


<?php 
$fail = "";
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($connection,$_POST['lg_un']);
    $password = mysqli_real_escape_string($connection,$_POST['lg_pass']);
    $sqlpre = mysqli_query($connection,"SELECT * FROM users WHERE firstname='$username'");
    $sqlpreexe = mysqli_fetch_array($sqlpre);
    $sqlcount = mysqli_num_rows($sqlpre);
    if ($sqlcount > 0 && $sqlpreexe['password'] == $password) {
        $_SESSION['user'] = $sqlpreexe['gen_id'];
        header("Location: add_post.php");
    }
    else{
        $fail = "username or password doesn't match!";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>for nati</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/blog-post.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">


    </head>

    <body>

        <!-- Navigation -->
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
                    <a class="navbar-brand" href="#">SE 2</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->


                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>

                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="col-md-8">
                <?php
                $select_all_posts_query  = mysqli_query($connection , "SELECT  * FROM posts");
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row ['post_title'];
                    $post_author = $row ['post_author'];
                    $post_date = $row ['post_date'];
                    $post_image = $row ['post_image'];
                    $post_content = $row ['post_content'];                    
                    echo '      <form action="login.php" method="post">      
                    <h2><a href="#"> '.$post_title.'</a></h2>
                    <p class="lead">by <a href="index.php"> '.$post_author.'</a></p>
                    <p><span class="glyphicon glyphicon-time"></span>  '.$post_date.'</p>
                    <hr>
                    <img class="img-responsive" src="images/'.$post_image.'" alt="">
                    <hr>
                    <p>'.$post_content.'</p>
                    <a class="btn btn-primary" href="#" name="readmore">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr> 
                    </form>'

                        ;        

                }
                ?>

            </div>



            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <div class="module">

                    <h1>Login to post</h1>
                    <form class="form" method="POST">
                        <center style="color: red;font-family: georgia;padding-bottom: 5px;"><?php
                            echo $fail;
                            ?></center>
                        <input type="text" placeholder="firstname" name="lg_un" class="textbox" />
                        <input type="text" placeholder="password" name="lg_pass" class="textbox" />
                        <input type="submit" name="login" value="Login" class="button w3-blue" />
                    </form>
            
                </div>

                    <form class="form" method="POST">
                       <h1>Sign up </h1>
                        <div class="form-group has-feedback" style="padding-bottom: 40px; ">
                            <div class="col-sm-10">
                                <input  name="fn" type="text" class="form-control" id="firstname"  placeholder="firstname">
                            </div>
                        </div>

                        <div class="form-group has-feedback" style="padding-bottom: 40px; ">
                            <div class="col-sm-10">
                                <input  name="ln" type="text" class="form-control" id="firstname"  placeholder="lastname">
                            </div>
                        </div>

                        <div class="form-group has-feedback" style="padding-bottom: 40px; ">
                            <div class="col-sm-10">
                                <input  name="age" type="text" class="form-control" id="firstname"  placeholder="age">
                            </div>
                        </div>

                        <div class="form-group has-feedback" style="padding-bottom: 40px; ">
                            <div class="col-sm-10">
                                <input  name="pass" type="Password" class="form-control" id="firstname"  placeholder="password">
                            </div>
                        </div>

                        <div class="form-group has-feedback" style="padding-bottom: 40px; ">
                            <div class="col-sm-10">
                                <input  name="repass" type="Password" class="form-control" id="firstname"  placeholder="re-type password">
                            </div>
                        </div>

                        <div class="form-group has-feedback" style="padding-bottom: 20px;">
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input  type="radio" name="gender" value="Male"> Male
                                </label>
                                <label class="radio-inline">
                                    <input  type="radio" name="gender" value="Female"> Female
                                </label>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="btn-sent" class="control-dis btn btn-primary"><i class="fa fa-plus-circle"></i> Register</button>
                            </div>
                        </div>
                    </form>

                    <!-- Login -->
                    <!--
<div class="well">
<h4>Login</h4>
<form action="login.php" method="post">
<div class="form-group">

<input type="text" name="username" class="form-control" placeholder="Enter Username">


</div>
<div class="input-group">
<input type="password" name="password" class="form-control" placeholder="Enter password">

<span class="input-group-btn">

<button class="btn btn-primary" name="login" type="submit">

Submit
</button>


</span>


</div>
</form>
/.input-group 
-->
                </div>




                </body>

            </html>
