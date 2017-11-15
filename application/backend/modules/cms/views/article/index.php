<h1><?php echo $title ?> 
<a class="btn btn-primary" href="<?php echo base_url('cms/article/add') ?>">New</a></h1>
<div><?php echo $pagination->create_links(); ?></div>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Sort order</td>
            <td>Active</td>
            <td></td>
        </tr>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo $article->id ?></td>
                <td><?php echo $article->title ?></td>
                <td><?php echo form_sort_order($article->id, $article->sort_order) ?></td>
                <td><?php echo form_link_active($article->id, $article->is_active) ?></td>
                <td>
                    <a href="<?php echo base_url('cms/article/edit/' . $article->id) ?>">Edit</a>
                    <a href="<?php echo base_url('cms/article/delete/' . $article->id) ?>" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<div><?php echo $pagination->create_links(); ?></div>
