<h1><?php echo $title ?></h1>

<?php echo form_open('cms/article/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $article->id); ?>
<div class="form-group"><label>Title</label> <?php echo form_input('title', $article->title, 'class="form-control"'); ?></div>
<div class="form-group"><label>Content</label> <?php echo form_textarea('content', $article->content, 'class="form-control"'); ?></div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>