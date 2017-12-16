<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$theme_url = base_url() . 'public/bds/';
?>

<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('html/head', ['theme_url' => $theme_url]); ?>
</head>
<body>
<header>
    <?php $this->load->view('html/header', ['theme_url' => $theme_url]); ?>
</header>
<div class="message">
    <?php $this->load->view('html/messages'); ?>
</div>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php $this->load->view($main_view) ?>
            </div>
            <div class="col-md-3">
                quang cao
            </div>
        </div>
    </div>
</section>
<br>
<hr>
<footer>
    <?php $this->load->view('html/footer', ['theme_url' => $theme_url]); ?>

    Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
</footer>

<?php $this->load->view('html/profiler'); ?>
</body>
</html>