<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="news-list">
    <ul>
    <?php foreach ($news as $item): ?>
        <li><a href="<?php echo news_url($item->cate_alias, $item->alias) ?>"><?php echo $item->title ?></a></li>
    <?php endforeach; ?>
    </ul>
</section>
