<h1><?php echo $title ?></h1>

<?php echo form_open('land/section/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $section->id); ?>
<div class="form-group">
    <label>Title</label> 
    <?php echo form_input('title', $section->title, 'class="form-control col-sm-5"'); ?>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>