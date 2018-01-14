<!DOCTYPE html>
<html lang='en' class=''>
<head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<body style="padding-top: 0px;">

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
                    <a class="nav-link" href="#">Home

                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">My Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
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

                <h3><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true" ></i>Edit the Post</h3>
                <form>
                    <div class="form-group" style="padding-top: 20px;">

                        <input type="text" class="form-control" id="title" placeholder="Type Post Title Here">
                    </div>


                    <div class="form-group" style="margin-top: 20px;">
                        <div id="summernote"></div>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-secondary text-uppercase text-center"
                           style=" color: white; float: right;">Cancel</a>
                        <a href="#" class="btn btn-secondary text-uppercase text-center"
                           style="color: white;">Publish</a>
                    </div>

                </form>
            </div>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
                    </div>
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="card my-4">
                <h5 class="card-header">Tags</h5>
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
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">JavaScript</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile -->
            <div class="card my-4">
                <h5 class="card-header">Profile</h5>
                <div class="card-body">
                    <img class="card-img-top" src="http://placehold.it/460x300" alt="Card image cap">

                    <p class="text-uppercase text-center text-muted" style="margin-top: 20px;"><strong>username</strong>
                    </p>
                    <p class="text-uppercase text-center text-muted" style="margin-top: 20px;">
                        <small>location</small>
                    </p>
                    <p class="text-uppercase text-center text-muted" style="margin-top: 20px;">
                        <small>industry</small>
                    </p>
                    <center><a href="#" class="btn btn-secondary-outline text-uppercase text-center"
                               style="margin-top:20px;border-color: #007bff; color: #007bff; border-radius: 32px;">view
                            profile</a>
                    </center>
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

<script type="text/javascript">
    $('#summernote').summernote({
        placeholder: 'Type Content Here',
        tabsize: 2,
        height: 500
    });
</script>

<!-- Bootstrap core JavaScript -->
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js'></script>

</body>
</html>