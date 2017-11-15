<?php $error = $this->session->flashdata('error'); ?>
<?php $success = $this->session->flashdata('success'); ?>
<?php if ($error): ?><div class="container"><div class="alert alert-danger"><?php echo $error ?></div></div><?php endif; ?>
<?php if ($success): ?><div class="container"><div class="alert alert-success"><?php echo $success ?></div></div><?php endif; ?>