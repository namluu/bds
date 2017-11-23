<h1><?php _e('Forgot password') ?></h1>
<?php echo form_open('', 'class="form"'); ?>
<?php echo $form_key  ?>
<div class="form-group">
    <?php echo form_input('email', set_value('email'), ['class' => 'form-control', 'placeholder' => __('Email')]); ?>
</div>
<button type="submit" class="btn btn-primary"><?php _e('Submit') ?></button>
<?php echo form_close(); ?>