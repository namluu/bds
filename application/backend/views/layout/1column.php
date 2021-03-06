<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$theme_url = base_url() . '';
?>

<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('html/head', ['theme_url' => $theme_url]); ?>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?php echo base_url('backend/dashboard') ?>">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <!--
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Customer</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url('customer/customer') ?>">Manage customers</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">CMS</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url('cms/category') ?>">Category</a>
                        <a class="dropdown-item" href="<?php echo base_url('cms/article') ?>">Article</a>
                    </div>
                </li>
            </ul>
            -->
            <form class="form-inline mt-2 mt-md-0 ml-md-auto">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Admin</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url('user/auth/logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container-fluid">
    <div class="row">
        <?php $this->load->view('html/nav'); ?>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <?php $this->load->view('html/messages'); ?>
            <?php $this->load->view($main_view) ?>
            <footer>
                <p>Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
                </p>
                <p><?php $this->load->view('html/profiler'); ?></p>
            </footer>
        </main>
    </div>
</div>

<script src="<?php echo $theme_url ?>js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $theme_url ?>js/popper.min.js"></script>
<script src="<?php echo $theme_url ?>js/bootstrap.min.js"></script>

<?php if (isset($image_upload)): ?>
<script>
var upload_url = "<?php echo base_url('upload/upload/index') ?>";
</script>
<link rel="stylesheet" href="<?php echo $theme_url ?>js/upload/css/jquery.fileupload.css"/>
<script src="<?php echo $theme_url ?>js/upload/js/jquery.ui.widget.js"></script>
<script src="<?php echo $theme_url ?>js/upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo $theme_url ?>js/upload/js/jquery.fileupload.js"></script>
<script src="<?php echo $theme_url ?>js/upload/js/myfileupload.js"></script>
<script src="<?php echo $theme_url ?>js/upload/js/imageupload.js"></script>
<?php endif ?>

<script src="<?php echo $theme_url ?>js/admin.js"></script>


    
</body>
</html>