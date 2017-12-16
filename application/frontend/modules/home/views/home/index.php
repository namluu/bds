<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-md-4">
        search
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
                <li class="list-group-item active">TIN RAO MỚI NHẤT</li>
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
                <li class="list-group-item active">TIÊU ĐIỂM TUẦN QUA</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
            </ul>
        </section>
    </div>
</div>
