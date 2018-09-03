<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item active">Tìm kiếm</li>
            <li class="list-group-item">
                <?php echo form_open('land/project/search', 'class="form"'); ?>
                <div class="form-group">
                    <?php echo form_input('key_word', null, 'class="form-control form-control-sm" placeholder="Nhập từ khóa"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_dropdown('category_id', $categories, null, 'class="form-control form-control-sm"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_dropdown('city_id', $cities, null, 'class="form-control form-control-sm" id="city_select"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_dropdown('district_id', $disctricts, null, 'class="form-control form-control-sm" id="district_select"'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                <?php echo form_close(); ?>
            </li>
        </ul>
    </div>
    <div class="col-md-8">
        <section class="news-list">
            <div class="news-slider">
            <?php foreach ($news as $item): ?>
                <div class="media-slick">
                    <a href="<?php echo news_url($item->cate_alias, $item->alias) ?>" class="media-img">
                        <?php if ($item->image): ?>
                            <img src="<?php echo base_url('images/cms/'.$item->id.'/'.$item->image) ?>" width="200" class="img-thumbnail" />
                        <?php else: ?>
                            <img src="<?php echo base_url('images/no-photo.jpg') ?>" width="200" class="img-thumbnail"/>
                        <?php endif ?>
                    </a>
                    <div class="media-body-slick">
                        <div class="mt-0">
                        <a href="<?php echo news_url($item->cate_alias, $item->alias) ?>">
                            <?php echo $item->title ?>
                        </a>
                        <p><?php echo strip_tags(word_limiter($item->content, 30)) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="slider-nav">
                <?php foreach ($news as $item): ?>
                <div><a href="<?php echo news_url($item->cate_alias, $item->alias) ?>"><?php echo $item->title ?></a></div>
            <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>
<hr>
<img src="<?php echo base_url('images/ads/20170930083550-b90a.jpg') ?>" width="100%">
<hr>
<div class="row">
    <div class="col-md-8">
        <section class="project-list">
            <ul class="list-group">
                <li class="list-group-item active">Tin rao mới nhất</li>
                <?php foreach ($land as $item): ?>
                <li class="list-group-item">
                    <div class="media">
                        <img src="<?php echo base_url('images/no-photo.jpg') ?>" width="120" class="img-thumbnail mr-3"/>
                        <div class="media-body">
                            <div class="project-title mt-0">
                                <h3><?php echo $item->title ?></h3>
                            </div>
                            <div class="project-content">
                                
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
    <div class="col-md-4">
        <section class="hot-news-list">
            <ul class="list-group">
                <li class="list-group-item active">Tiêu điểm tuần qua</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
            </ul>
        </section>
    </div>
</div>
