<h1><?php echo $title ?></h1>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Sort order</td>
            <td>Active</td>
            <td></td>
        </tr>
        <?php foreach ($categories as $cate): ?>
            <tr>
                <td><?php echo $cate->id ?></td>
                <td><?php echo $cate->title ?></td>
                <td><?php echo form_sort_order($cate->id, $cate->sort_order) ?></td>
                <td><?php echo form_link_active($cate->id, $cate->is_active) ?></td>
                <td>
                    <a href="<?php echo base_url('cms/category/edit/' . $cate->id) ?>">Edit</a>
                    <a href="<?php echo base_url('cms/category/delete/' . $cate->id) ?>" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>    
</div>

<a href="<?php echo base_url('cms/category/add') ?>">New</a>