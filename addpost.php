<?php
session_start();
if (isset($_POST['action'])) {
    connectDB();

}
function connectDB() {

    try {
        $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO posts (title, body, user_id, created_at, updated_at) VALUES (:title, :body, :userid, :created_at, :updated_at )");

        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':body', $_POST['body']);
        $stmt->bindValue(':userid', $_SESSION['id']);
        $stmt->bindValue(':created_at', date("Y-m-d H:i:s"));
        $stmt->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
    catch(PDOException $e)
    {
    }
}
?>

<!DOCTYPE html>
<html lang='en' class='' xmlns="http://www.w3.org/1999/html">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>

<body style="padding-top: 0px;">


<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                    </a>
                </li>
                <?php
                function isLoggedIn()
                {

                    if (isset($_SESSION['id'])) {
                        $userid = $_SESSION['id'];
                        try {
                            $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt_1 = $conn->prepare("SELECT * FROM user WHERE id = ?");
                            $stmt_1->bindParam(1, $userid);
                            $stmt_1->execute();
                        } catch (PDOException $e) {
                        }
                        return true;
                    } else {
                        return false;
                    }
                }
                ?>
                <?php if (!isLoggedIn()) : ?>
                    <li class="nav-item" id="login">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item" id="post">
                        <a class="nav-link" href="postlist.php">My Post
                        </a>
                    </li>
                    <li class="nav-item" id="logout">
                        <a class="nav-link" href="logout.php">Logout
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row" style="margin-top: 60px;">

        <!-- Blog Entries Column -->
        <div class="col-md-8" style="margin-top: 40px;">

            <div class="col-sm-12">

                <h3><i class="fa fa-pencil fa-lg" aria-hidden="true" ></i>Add New Post</h3>
                <form id="postForm" method="post" enctype="multipart/form-data" >
                    <div class="form-group" style="padding-top: 20px;">

                        <input type="text" class="form-control" id="title" name="title" placeholder="Type Post Title Here">
                    </div>


                    <div class="form-group" style="margin-top: 20px;">
                        <textarea id="body" name="body" class="form-control" style="height: 300px;" placeholder="Type Post Content Here"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="postlist.php" class="btn btn-secondary text-uppercase text-center"
                           style=" color: white; float: right;">Cancel</a>
                        <input type="submit"  class="btn btn-secondary text-uppercase text-center"
                               style="color: white;"  value="Publish" name="action">

                    </div>

                </form>

                <p id="test"></p>
            </div>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4" style="margin-top: 25px;">

            <div class="card my-4">
                <h5 class="card-header"><i class="fa fa-archive"></i> Archives</h5>
                <div class="card-body">
                    <div class="row">
                        <ul>
                            <li>
                                <a href="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="card my-4">
                <h5 class="card-header"><i class="fa fa-tags"></i>Tags</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <a href="#">HTML</a>
                                </li>
                                <li>
                                    <a href="#">Freebies</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>



        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<!-- Footer -->
<footer class="py-4 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>








<!-- Bootstrap core JavaScript -->
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js'></script>

</body>
</html>