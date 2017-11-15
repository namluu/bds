<?php $error = $this->session->flashdata('error'); ?>
<?php $success = $this->session->flashdata('success'); ?>
<?php if ($error): ?><div class="alert alert-danger"><?php echo $error ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success"><?php echo $success ?></div><?php endif; ?>