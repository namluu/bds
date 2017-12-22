<h1><?php echo $title ?></h1>

<?php echo form_open('land/project/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $project->id); ?>
<div class="form-group">
    <label>Title</label> 
    <?php echo form_input('title', $project->title, 'class="form-control col-sm-5"'); ?>
</div>
<div class="form-group">
    <label>Category</label> 
    <?php echo form_dropdown('category_id', $categories, $project->category_id, 'class="form-control col-sm-5"'); ?>
</div>
<div class="form-group">
    <label>Content</label> 
    <?php echo form_textarea('content', $project->content, 'class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>