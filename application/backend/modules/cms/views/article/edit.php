<h1><?php echo $title ?></h1>

<?php echo form_open_multipart('cms/article/edit', 'class="form"'); ?>
<?php echo form_hidden('id', $article->id); ?>
<div class="form-group"><label>Title</label> <?php echo form_input('title', $article->title, 'class="form-control"'); ?></div>
<div class="form-group"><label>Content</label> <?php echo form_textarea('content', $article->content, 'class="form-control"'); ?></div>
<div class="form-group">
<div class="row">
    <div class="col-md-6">
        <label>Image</label> 
        <input type="file" class="browse-input" id="uploadFile" name="files[]" accept="image/png,image/jpeg,image/jpg,image/gif"> 
        <span style="font-size:11px;">Formats: JPG, PNG, GIF</span> <br />
        <span style="font-size:11px;color:#ff0000;">Kích thước chuẩn <u>min width: 780(pixel)</u></span>
        <div id="progress" style="height:5px">
            <div class="progress" style="height:5px;">
                <div class="progress-bar"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 images-list">
        <?php if ($article->image): ?>
            <img src="<?php echo root_url('images/cms/'.$article->id.'/thumb_65_65_crop_'.$article->image) ?>" width="65"/>
            <input type="hidden" name="images[ids][]" value="<?php echo $article->id ?>" />
            <a href="javascript:void(0)" onclick="javascript:mydeleteFile(this,'img');" data-type="DELETE" 
                data-url="<?php echo base_url('cms/article/delete_image?cid='.$article->id) ?>">
                <span class="glyphicon glyphicon-trash"></span> delete
            </a>
        <?php endif?>
    </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>