<h1><?php echo $title ?></h1>

<?php echo form_open('land/category/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $category->id); ?>
<div class="form-group">
    <label>Title</label> 
    <?php echo form_input('title', $category->title, 'class="form-control col-sm-5"'); ?>
</div>
<div class="form-group">
    <label>Section</label> 
    <?php echo form_dropdown('section_id', $sections, $category->section_id, 'class="form-control col-sm-5"'); ?>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>