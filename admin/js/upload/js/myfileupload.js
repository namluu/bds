(function($) {
	
    $.myfileupload = function(el, options) {
		var control = this;
			control.options = $.extend({},$.myfileupload.defaultOptions, options);
			control.$el = $(el);
        control.init = function() {		
			// Change this to the location of your server-side upload handler:
			control.$el.fileupload({
				url: control.options.url,
				add: function (e, data) {
					if(jQuery.isFunction(control.options.add)){
						control.options.add(e,data);
					}else{
						var goUpload = true;
						var uploadFile = data.files[0];
						if (!(/\.(gif|jpg|jpeg|png)$/i).test(uploadFile.name)) {
							alert('You must select an image file only');
							goUpload = false;
						}
						if (uploadFile.size > 2000000) { // 2mb
							alert('Please upload a smaller image, max size is 2 MB');
							goUpload = false;
						}
						if (goUpload == true) {
							data.submit();
						}
					}
				},
				dataType: 'json',
                done: function (e, data) {
					if(jQuery.isFunction(control.options.done)){
						control.options.done(e,data);
					}else{
						jQuery.each(data.result.files, function (index, file) {
							if(file.error){
								alert(file.error);
							}else{
								var count_items = jQuery(control.options.element_embed).children().size();
								var html = '<tr>';
									html = html + '<td><img src="'+ file.thumbnailUrl +'"/><input type="hidden" name="images[image]['+count_items+']" value="'+file.name+'" /></td>';
									html = html + '<td><a href="javascript:void(0)" onclick="javascript:mydeleteFile(this,\'img\');" data-type="DELETE" data-url="'+file.deleteUrl+'"><span class="glyphicon glyphicon-trash"></span> xóa</a></td>';
									html = html + '<td><input type="radio" name="images[default]" value="'+count_items+'" /></td>';
									html = html + '</tr>';
								jQuery(control.options.element_embed).append(html);
								$('#progress').animate({opacity:1},2000,function(){
									$('#progress .progress-bar').css(
										'width','0%'
									);
								});
								
							}
							
						});
					}
				},
				progressall: function (e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
				}
			});
        };		
        control.init();
    };
    
    $.myfileupload.defaultOptions = {
        url:'',
		element_embed: '.images-list',
		add:{},
		done:{}
    };
    
    $.fn.myfileupload = function(options) {
        return this.each(function() {
            (new $.myfileupload(this, options));
        });
    };
	mydeleteFile = function(ele,item){
		item = item || '.image';
		var $ele = jQuery(ele);
		jQuery.ajax({
			method:'POST',
			url:$ele.attr('data-url'),
			data:{_method:$ele.attr('data-type')},
			success:function(data){
				$ele.parent().find(item).hide('fast',function(){
					jQuery(this).remove();
					$ele.hide('fast');
				});
				
			}
		});
	}
})(jQuery);