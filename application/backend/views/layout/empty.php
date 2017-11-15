<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($title)? config_item('site_name') . ' | ' . $title : config_item('site_name'); ?></title>
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