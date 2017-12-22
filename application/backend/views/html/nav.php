<?php
$GLOBALS['module'] = $this->uri->segment('1');
$GLOBALS['uri_string'] = $this->uri->uri_string();
function isActive($name, $type = 'link') {
    if ($name == $GLOBALS['module']) {
        if ($type == 'link') {
            echo 'active';
        } else {
            echo 'show';
        }
    }
}

function isActiveHome() {
    if ($GLOBALS['uri_string'] == 'backend/dashboard') {
        echo 'active';
    }
}
?>
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link <?php isActiveHome() ?>" href="<?php echo base_url() ?>">Dashboard</a>
        </li>
        <li class="nav-item">
            <div id="accordion" role="tablist">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse1">Customer</a>
                        </h5>
                    </div>
                    <div id="collapse1" class="collapse <?php isActive('customer', 'collapse') ?>" data-parent="#accordion">
                        <div class="card-body">
                            <p><a href="<?php echo base_url('customer/customer') ?>">Manage customers</a></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse2">CMS</a>
                        </h5>
                    </div>
                    <div id="collapse2" class="collapse <?php isActive('cms', 'collapse') ?>" data-parent="#accordion">
                        <div class="card-body">
                            <p><a href="<?php echo base_url('cms/category') ?>">Category</a></p>
                            <p><a href="<?php echo base_url('cms/article') ?>">Article</a></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapse3">Land</a>
                        </h5>
                    </div>
                    <div id="collapse3" class="collapse <?php isActive('land', 'collapse') ?>" data-parent="#accordion">
                        <div class="card-body">
                            <p><a href="<?php echo base_url('land/project') ?>">Project</a></p>
                            <p><a href="<?php echo base_url('land/category') ?>">Category</a></p>
                            <p><a href="<?php echo base_url('land/section') ?>">Section</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="#">Overview <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Analytics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Export</a>
        </li>
    </ul>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="#">Nav item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Nav item again</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">One more nav</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Another nav item</a>
        </li>
    </ul>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="#">Nav item again</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">One more nav</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Another nav item</a>
        </li>
    </ul>
</nav>