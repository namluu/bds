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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo base_url('backend/dashboard') ?>">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
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
    </div>
</header>
<div class="message">
    <div class="container">
        <?php $this->load->view('html/messages'); ?>
    </div>
</div>
<div class="container">
    <?php $this->load->view($main_view) ?>
</div>
<br>
<hr>
<footer>
    Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
</footer>
<script src="<?php echo $theme_url ?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo $theme_url ?>js/popper.min.js"></script>
<script src="<?php echo $theme_url ?>js/bootstrap.min.js"></script>
<script src="<?php echo $theme_url ?>js/admin.js"></script>
<?php $this->load->view('html/profiler'); ?>
    
</body>
</html>