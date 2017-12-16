jQuery(document).ready(function($){
    $('#uploadFile').myfileupload({
        url:upload_url,
        done: function(e, data){
            jQuery.each(data.result.files, function (index, file) {
                if(file.error){
                    alert(file.error);
                }else{
                    var count_items = 0;
                    var html = '';
                        html = html + '<img src="'+ file.thumbnailUrl +'"/><input type="hidden" name="images[image]" value="'+file.name+'" /><br />';
                        html = html + '<a href="javascript:void(0)" onclick="javascript:mydeleteFile(this,\'img\');" data-type="DELETE" data-url="'+file.deleteUrl+'"><span class="glyphicon glyphicon-trash"></span> xóa</a>';
                    jQuery('.images-list').html(html);
                    $('#progress').animate({opacity:1},2000,function(){
                        $('#progress .progress-bar').css(
                            'width','0%'
                        );
                    });
                }
            });
        }
    });
});