<?php
if(isset($_POST['register'])){
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password_confirmation'];



    try {
        $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt_1 = $conn->prepare("insert into user(email, password, username) values(?,?,?)");
        $stmt_1->bindParam(1, $email);
        $stmt_1->bindParam(2, $password);
        $stmt_1->bindParam(3, $username);
        $stmt_1->execute();

        $result = $conn->lastInsertId();
        if($result != ""){
            session_start();
            $_SESSION['id'] = $result ;//get id from result give it to session
            header('Location: index.php');
        } else {
            echo "Account invalid";
        }
    } catch (PDOException $e) {
    }


}
?>

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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
            integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>


    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

</head>

<body style="background-color: #efefef">


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Blogger</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container" style="margin-top: 100px; height: 600px; ">
    <div class="row">

        <div class="col-md-4">
        </div>

        <!-- Blog Entries Column -->

        <div class="col-md-4">
            <center><h1 style="color: #aaaaaa;font-weight: bold;">
                    Register
                </h1></center>
            <form method="post">
                <?php if(isset($_POST['register']) && $_POST['password'] != $_POST['password_confirmation']): ?>
                <div class="form-group">
                    <div class="alert alert-danger">
                        The password is not match.
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-user"
                                   aria-hidden="true"
                                   style="width: 30px;"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                               aria-describedby="basic-addon1" id="name" name="name">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-envelope"
                                   aria-hidden="true"
                                   style="width: 30px;"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                               aria-describedby="basic-addon1" id="email" name="email">
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock fa-lg"
                                                                                aria-hidden="true"
                                                                                style="width: 30px;"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                               aria-describedby="basic-addon1" id="password" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock fa-lg"
                                                                                aria-hidden="true"
                                                                                style="width: 30px;"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password Confirmation" aria-label="Password Confirmation"
                               aria-describedby="basic-addon1" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-secondary" style="width: 150px; float: left;" name="register">Register
                    </button>
                    <a href="index.php">
                        <button type="button" class="btn btn-outline-secondary" style="width: 150px; float: right;">
                            Cancel
                        </button>
                    </a>
                </div>


            </form>
        </div>

        <div class="col-md-4">
        </div>

    </div>


</div>

</div>

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

</body>

</html>
