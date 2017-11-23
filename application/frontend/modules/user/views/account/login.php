<h1><?php _e('Login') ?></h1>
<?php echo form_open('', 'class="form"'); ?>
<?php echo $form_key  ?>
<div class="form-group">
    <?php echo form_input('email', set_value('email'), ['class' => 'form-control', 'placeholder' => __('Email')]); ?>
</div>
<div class="form-group">
    <?php echo form_password('password', null, ['class' => 'form-control', 'placeholder' => __('Password')]); ?>
</div>
<button type="submit" class="btn btn-primary"><?php _e('Login') ?></button>
<a href="<?php echo base_url('user/account/forgotpassword') ?>" class=""><?php _e('Forgot password') ?></a>
<?php echo form_close(); ?>
<hr>
<h2><?php _e('Login social') ?></h2>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary btn-block" href="<?php echo base_url('user/social/facebook') ?>">Facebook</a>
    </div>
    <div class="col-md-6">
        <a class="btn btn-primary btn-block" href="<?php echo base_url('user/social/google') ?>">Gmail</a>
    </div>
</div>

<hr>
<a href="<?php echo base_url('user/account/create') ?>"><?php _e('Register') ?></a>