<h1><?php echo $title ?></h1>

<?php echo form_open('cms/category/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $category->id); ?>
<div class="form-group"><label>Title</label> <?php echo form_input('title', $category->title, 'class="form-control"'); ?></div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>