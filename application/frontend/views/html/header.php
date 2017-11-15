<div class="container">
    <div class="header-top">
        <div class="row">
            <div class="header-top-left col-md-3">
                <a href="<?php echo base_url() ?>"><img src="<?php echo $theme_url ?>images/logo-bds.png"></a>
            </div>
            <div class="header-top-right col-md-9">
                <img src="<?php echo $theme_url ?>images/ads.jpg" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="clearfix">
        <div class="float-right">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="<?php echo base_url('customer/account/create') ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php _e('Register') ?></a></li>
                <li class="list-inline-item"><a href="<?php echo base_url('customer/account/login') ?>"><?php echo _e('Login') ?></a></li>
                <li class="list-inline-item">
                    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;" class="selectpicker">
                        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?> data-content="<img src='<?php echo $theme_url ?>images/cy-GB.png' width='24'> English">English</option>
                        <option value="vietnamese" <?php if($this->session->userdata('site_lang') == 'vietnamese') echo 'selected="selected"'; ?> data-content="<img src='<?php echo $theme_url ?>images/vietnam.gif'> Việt Nam">Việt Nam</option>
                    </select>
                </li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url() ?>">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Nhà đất bán</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Bán căn hộ chung cư</a>
                        <a class="dropdown-item" href="#">Bán nhà riêng</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Nhà đất cho thuê</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Cho thuê căn hộ chung cư</a>
                        <a class="dropdown-item" href="#">Cho thuê nhà riêng</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Tin tức</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Tin thị trường</a>
                        <a class="dropdown-item" href="#">Phân tích</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>