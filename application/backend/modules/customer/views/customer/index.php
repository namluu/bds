<h1><?php echo $title ?></h1>
<table border="1" cellspacing="1" cellpadding="5">
    <tr>
        <td>ID</td>
        <td>Email</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Active</td>
        <td></td>
    </tr>
    <?php foreach ($customers as $cus): ?>
        <tr>
            <td><?php echo $cus->id ?></td>
            <td><?php echo $cus->email ?></td>
            <td><?php echo $cus->firstname ?></td>
            <td><?php echo $cus->lastname ?></td>
            <td><?php echo form_link_active($cus->id, $cus->is_active) ?></td>
            <td>
                <a href="<?php echo base_url('customer/customer/edit/' . $cus->id) ?>">Edit</a>
                <a href="<?php echo base_url('customer/customer/delete/' . $cus->id) ?>" onclick="return confirmDelete();">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<a href="<?php echo base_url('customer/customer/add') ?>">New</a>