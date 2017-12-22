<h1><?php echo $title ?></h1>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td width="400">Title</td>
            <td>Category</td>
            <td>Active</td>
            <td></td>
        </tr>
        <?php foreach ($projects as $obj): ?>
            <tr>
                <td><?php echo $obj->id ?></td>
                <td><?php echo $obj->title ?></td>
                <td><?php echo $obj->cat_title ?></td>
                <td><?php echo form_link_active($obj->id, $obj->is_active) ?></td>
                <td>
                    <a href="<?php echo base_url('land/project/edit/' . $obj->id) ?>">Edit</a>
                    <a href="<?php echo base_url('land/project/delete/' . $obj->id) ?>" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>    
</div>

<a href="<?php echo base_url('land/project/add') ?>" class="btn btn-primary">New</a>