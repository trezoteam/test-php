<?php use Module\Quiz\View\SRC\Template\Site as View_Site; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= View_Site::getPageTitle() ?> | Quiz</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="/resources/packages/mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/resources/packages/mdbootstrap/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="/resources/packages/mdbootstrap/css/style.css" rel="stylesheet">
    <link href="/resources/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="/" target="_blank">
                <strong class="blue-text">Quiz</strong>
            </a>
            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="/">Home Page</a>
                    </li>
                </ul>
                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="/admin/login/" class="nav-link border border-light rounded waves-effect">Admin Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
	<!-- Content Page -->
	<?php require_once View_Site::getPageDir(); ?>
	<!-- Content Page -->
    <!--Footer-->
    <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">
        <hr class="my-4">
        <div class="footer-copyright py-3">
            <h4>teste-php Quiz</h4>
        </div>
    </footer>
    <!--/.Footer-->
    <!-- SCRIPTS -->
    <script type="text/javascript" src="/js/template/site.js"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="/resources/packages/jquery/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="/resources/packages/mdbootstrap/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="/resources/packages/mdbootstrap/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/resources/packages/mdbootstrap/js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>
</body>
</html>