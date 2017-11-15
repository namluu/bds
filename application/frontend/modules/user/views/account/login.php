<h1>Login</h1>
<?php echo form_open('customer/account/login', 'class="form"'); ?>
<?php echo $form_key  ?>
<p>Email: <?php echo form_input('email'); ?></p>
<p>Password: <?php echo form_password('password'); ?></p>
<button type="submit">Login</button>
<?php echo form_close(); ?>
<hr>
<h2>Login social</h2>
<ul class="login-social text-center">
    <li><a href="<?php echo base_url('customer/auth/facebook') ?>">Facebook</a></li>
    <li><a href="<?php echo base_url('customer/auth/google') ?>">Gmail</a></li>
    <li><a href="<?php echo base_url('customer/auth/github') ?>">Github</a></li>
</ul>
<hr>
<a href="<?php echo base_url('customer/account/create') ?>">Register</a>