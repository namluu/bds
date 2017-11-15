<h1><?php _e('Create New Customer Account') ?></h1>
<br>
<?php echo form_open('customer/account/create', 'class="form"'); ?>
<div class="form-group">
    <?php echo form_input('firstname', set_value('firstname'), ['class' => 'form-control', 'placeholder' => __('Firstname')]); ?>
</div>
<div class="form-group">
    <?php echo form_input('lastname', set_value('lastname'), ['class' => 'form-control', 'placeholder' => __('Lastname')]); ?>
</div>
<div class="form-group">
    <?php echo form_input('email', set_value('email'), ['class' => 'form-control', 'placeholder' => __('Email')]); ?>
</div>
<div class="form-group">
    <?php echo form_password('password', null, ['class' => 'form-control', 'placeholder' => __('Password')]); ?>
</div>
<div class="form-group">
    <?php echo form_password('password_confirmation', null, ['class' => 'form-control', 'placeholder' => __('Confirm Password')]); ?>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <?php echo form_input('captcha', null, ['class' => 'form-control', 'placeholder' => __('Input captcha')]); ?>
    </div>
    <div class="form-group col-md-6">
        <?php echo $captcha['image'] ?>
    </div>
</div>
<button type="submit" class="btn btn-primary"><?php _e('Register') ?></button>
<?php echo form_close(); ?>