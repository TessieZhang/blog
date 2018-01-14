<?php
session_start();

if(isset($_GET['delete_id'])) {

    try {
        $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bindParam(1, $_GET['delete_id']);
        $stmt->execute();
        header("Location: postlist.php");
    } catch (PDOException $e) {

    }
}
?>

<script type="text/javascript">
    function delete_data(id)
    {
        if(confirm('Are you sure you want to delete this post?'))
        {
            window.location.href='postlist.php?delete_id='+ id;
        }
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

                <li class="nav-item active">
                    <a class="nav-link" href="#">My Post
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8" style="padding-top: 40px;">

            <h4 style="padding-bottom: 15px;">All posts<a href="addpost.php" class="btn pull-right"><i
                        class="fa fa-plus fa-lg" aria-hidden="true"></i></a></h4>


            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>

                    <th>Title</th>
                    <th>Date</th>
                    <th>Edit</th>

                    <th>Delete</th>
                    </thead>

                    <tbody>
                    <?php
                    try {
                    $conn = new PDO("mysql:host=localhost;dbname=blogproject", "root", "");

                    $stmt = $conn->prepare("SELECT * FROM posts where user_id = ?");

                    $stmt->bindParam(1, $_SESSION['id']);
                    $stmt->execute();
                    $result = $stmt->fetchColumn();

                    $result_1 = $stmt->fetchALL();
                    if (!empty($result)) {
                    foreach ($result_1 as $row) {
                     echo "<tr>
                        <td><a href=\"postdetail.php?id=".$row['id']."\"> ".$row['title']."</a></td>
                        <td>".$row['created_at']."</td>
                        <td>
                            <a href=\"edit.php?id=".$row['id']."\" class=\"btn btn-primary\" ><i class=\"fa fa-pencil-square-o fa-lg\"
                            aria-hidden=\"true\" ></i></a>

                        </td>
                        <td>
                            <a href=\"javascript:delete_data(".$row['id'].")\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                        </td>
                    </tr>";


                    }
                    }
                    //设置向前翻页的跳转


                    } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    }
                    ?>

                    </tbody>

                </table>
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item">


                    </li>
                    <li class="page-item disabled">


                    </li>
                </ul>
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
</div>

<a href="#delete/id"
<!-- edit profile dialog-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control " type="text" placeholder="Mohsin">
                </div>
                <div class="form-group">

                    <input class="form-control " type="text" placeholder="Irshad">
                </div>
                <div class="form-group">
                    <textarea rows="2" class="form-control"
                              placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span
                        class="glyphicon glyphicon-ok-sign"></span> Update
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Footer -->
<footer class="py-4 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Tessie 2017</p>
    </div>
    <!-- /.container -->
</footer>

<div class="modal fade" id="modal-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Please Confirm</h4>
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                    Are you sure you want to delete this post?
                </p>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" name="delete">
                    <i class="fa fa-times-circle"></i> Yes
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>