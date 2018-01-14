<?php
session_start();
?>
<!-- blog homepage  -->

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
            integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

</head>
<body>


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

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8" style="margin-top: 50px;">


            <?php

            if (isset($_GET['tag'])) {
                try {
                    $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $stmt = $conn->prepare("SELECT * FROM posts WHERE id IN (SELECT post_id FROM post_tag WHERE tag_id IN (SELECT id FROM tags WHERE name = ?))");
                    $stmt->bindParam(1, $_GET['tag']);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {
                        echo "<div class=\"card mb-4\">
                <div class=\"card-body\">
                    <h2 class=\"card-title\">" . $row['title'] . "</h2>" . $row['body'] . "</p>
                </div>
                <div class=\"card-footer text-muted\">
                    Posted on " . $row['created_at'] . "
                </div>
            </div>";
                    }
                } catch (PDOException $e) {

                }

            } else if (isset($_GET['year']) && isset($_GET['month'])) {
                try {
                    $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $stmt = $conn->prepare("SELECT * FROM posts WHERE YEAR(created_at) = ? AND MONTH(created_at) = ?");
                    $stmt->bindParam(1, $_GET['year']);
                    $stmt->bindParam(2, $_GET['month']);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {
                        echo "<div class=\"card mb-4\">
                <div class=\"card-body\">
                    <h2 class=\"card-title\">" . $row['title'] . "</h2>" . $row['body'] . "</p>
                </div>
                <div class=\"card-footer text-muted\">
                    Posted on " . $row['created_at'] . "
                </div>
            </div>";
                    }
                } catch (PDOException $e) {

                }


            } else {
                try {
                    $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $stmt = $conn->prepare("SELECT * FROM posts");
                    $stmt->execute();
                    $result = $stmt->fetchALL();
                    foreach ($result as $row) {
                        echo "<div class=\"card mb-4\">
                <div class=\"card-body\">
                    <h2 class=\"card-title\">" . $row['title'] . "</h2>" . $row['body'] . "</p>
                </div>
                <div class=\"card-footer text-muted\">
                    Posted on " . $row['created_at'] . "
                </div>
            </div>";
                    }
                } catch (PDOException $e) {

                }
            }


            ?>


        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4" style="margin-top: 25px;">

            <div class="card my-4">
                <h5 class="card-header"><i class="fa fa-archive"></i> Archives</h5>
                <div class="card-body">
                    <div class="row">
                        <?php
                        try {
                            $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt_1 = $conn->prepare("SELECT YEAR(created_at) AS YEAR, MONTH(created_at) AS MONTH, COUNT(*) AS TOTAL FROM posts GROUP BY YEAR, MONTH");


                            $stmt_1->execute();
                            $result = $stmt_1->fetchAll();


                            foreach ($result as $row) {
                                $format = 'Y-m';
                                $date = DateTime::createFromFormat($format, $row[0] . "-" . $row[1]);
                                echo "<ul>
                            <li>
                                <a href=\"index.php?year=" . $row[0] . "&month=" . $row[1] . "\">" . $date->format('M-Y') . "</a>
                            </li>
                        </ul>";
                            }


                        } catch (PDOException $e) {
                        }
                        ?>

                    </div>
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="card my-4">
                <h5 class="card-header"><i class="fa fa-tags"></i>Tags</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <?php
                            try {
                                $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt_2 = $conn->prepare("SELECT * FROM tags");

                                $stmt_2->execute();
                                $result_1 = $stmt_2->fetchAll();

                                foreach ($result_1 as $row) {
                                    echo "<ul class=\"list-unstyled mb-0\">
                            <li>
                                <a href=\"index.php?tag=" . $row['name'] . "\">" . $row['name'] . "</a>
                            </li>
                        </ul>";
                                }


                            } catch (PDOException $e) {
                            }
                            ?>


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