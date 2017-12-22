<h1><?php echo $title ?></h1>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Section</td>
            <td>Sort order</td>
            <td>Active</td>
            <td></td>
        </tr>
        <?php foreach ($categories as $obj): ?>
            <tr>
                <td><?php echo $obj->id ?></td>
                <td><?php echo $obj->title ?></td>
                <td><?php echo $obj->sec_title ?></td>
                <td><?php echo form_sort_order($obj->id, $obj->sort_order) ?></td>
                <td><?php echo form_link_active($obj->id, $obj->is_active) ?></td>
                <td>
                    <a href="<?php echo base_url('land/category/edit/' . $obj->id) ?>">Edit</a>
                    <a href="<?php echo base_url('land/category/delete/' . $obj->id) ?>" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>    
</div>

<a href="<?php echo base_url('land/category/add') ?>" class="btn btn-primary">New</a>