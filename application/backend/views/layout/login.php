<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$theme_url = base_url() . '';
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($title)? config_item('site_name') . ' | ' . $title : config_item('site_name'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo $theme_url ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $theme_url ?>css/signin.css">
</head>
<body>
<header>
</header>
<div class="message">
    <?php $this->load->view('html/messages'); ?>
</div>
<div class="container">
    <?php $this->load->view($main_view) ?>
</div>
<footer>
</footer>
</body>
</html>