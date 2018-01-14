<?php
session_start();
$id = $_GET['id'];
$username = $_SESSION['username'];

if(isset($_POST['comment'])){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, body, created_at) VALUES (?, ?, ?, ?)");

        $stmt->bindParam(1, $id);
        $stmt->bindValue(2, $_SESSION['id']);
        $stmt->bindValue(3, $_POST['message']);
        $stmt->bindValue(4, date("Y-m-d H:i:s"));
        $stmt->execute();
        header("Location: postdetail.php?id=".$id);
        exit;
    }
    catch(PDOException $e)
    {
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">


    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
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
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt_1 = $conn->prepare("SELECT * FROM user WHERE id = ?");
                            $stmt_1->bindParam(1, $userid);
                            $stmt_1->execute();

                            $username = $stmt_1->fetchColumn(3);

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
                        <a class="nav-link" href="login.php" >Login</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item" id="post">
                        <a class="nav-link" href="postlist.php"><?php echo $_SESSION['username'] ?>
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

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
            <?php
            try {
                $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
// set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");

                $stmt->bindParam(1, $id);
                $stmt->execute();
                $result = $stmt->fetch();
                $title = $result['title'];
                $content = $result['body'];
                $created_at = $result['created_at'];

//                $stmt_1 = $conn->prepare("SELECT username FROM user where user_id = ?");
//
//                $stmt_1->bindParam(1, $_SESSION['id']);
//                $stmt_1->execute();

                echo "<h1 class=\"mt-4\">".$title."</h1>

            <!-- Date/Time --><hr>
            <p style=\"font-size: 14px; margin-bottom: 5px; \"><i class=\"fa fa-calendar\"></i> Posted on ".$created_at."</p>

            <p style=\"font-size: 14px;\"><i class=\"fa fa-tags\"></i> Tags:
                <a href=\"#\" style=\"color: white;\">  <span class=\"badge badge-pill badge-secondary\">aaa</span></a>

            </p>

            <hr>

            <!-- Post Content -->
           <p>".$content."</p>"
           ;

            }
            catch(PDOException $e)
            {

            }
            ?>

            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="post" >
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="message"></textarea>
                        </div>
                        <input type="submit"  class="btn btn-primary"
                              value="Submit" name="comment">
                    </form>
                </div>
            </div>



            <!-- Single Comment -->
            <div class="media mb-4">
                <div class="media-body">
                    <?php
                    try {
                        $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ");

                        $stmt->bindParam(1, $id);
                        $stmt->execute();
                    $result = $stmt->fetchALL();
                    foreach ($result as $row) {
                        echo "<h5 class=\"mt-0\">".$_SESSION['username']."</h5>
                        
                    ".$row['body']."<hr>";
                    }

                    }
                    catch(PDOException $e)
                    {
                    }
                    ?>

                    </div>
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
        <p class="m-0 text-center text-white">Copyright &copy; Tessie 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
