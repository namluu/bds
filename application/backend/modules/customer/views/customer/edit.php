<h1><?php echo $title ?></h1>

<?php echo form_open('customer/customer/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $customer->id); ?>
<p>Title: <?php echo form_input('email', $customer->email); ?></p>
<button type="submit">Submit</button>
<?php echo form_close(); ?>