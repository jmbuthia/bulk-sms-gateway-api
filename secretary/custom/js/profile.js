		jQuery(document).ready(function(){
		
		jQuery('#change-pic').on('click', function(e){
	        jQuery('#changePic').show();
			jQuery('#change-pic').hide();
	        
	    });
		
		jQuery('#photoimg').on('change', function()   
		{ 
			jQuery("#preview-avatar-profile").html('');
			jQuery("#preview-avatar-profile").html('Uploading picture....');
			jQuery("#cropimage").ajaxForm(
			{
			target: '#preview-avatar-profile',
			success:    function() { 
					jQuery('img#photo').imgAreaSelect({
					aspectRatio: '1:1',
					onSelectEnd: getSizes,
				});
				jQuery('#image_name').val(jQuery('#photo').attr('file-name'));
				}
			}).submit();

		});
		
		jQuery('#btn-crop').on('click', function(e){
	    e.preventDefault();
	    params = {
	            targetUrl: 'profile_controller.php?action=save',
	            action: 'save',
	            x_axis: jQuery('#hdn-x1-axis').val(),
	            y_axis : jQuery('#hdn-y1-axis').val(),
	            x2_axis: jQuery('#hdn-x2-axis').val(),
	            y2_axis : jQuery('#hdn-y2-axis').val(),
	            thumb_width : jQuery('#hdn-thumb-width').val(),
	            thumb_height:jQuery('#hdn-thumb-height').val()
	        };

	        saveCropImage(params);
	    });
	    
	 
	    
	    function getSizes(img, obj)
	    {
	        var x_axis = obj.x1;
	        var x2_axis = obj.x2;
	        var y_axis = obj.y1;
	        var y2_axis = obj.y2;
	        var thumb_width = obj.width;
	        var thumb_height = obj.height;
	        if(thumb_width > 0)
	            {

	                jQuery('#hdn-x1-axis').val(x_axis);
	                jQuery('#hdn-y1-axis').val(y_axis);
	                jQuery('#hdn-x2-axis').val(x2_axis);
	                jQuery('#hdn-y2-axis').val(y2_axis);
	                jQuery('#hdn-thumb-width').val(thumb_width);
	                jQuery('#hdn-thumb-height').val(thumb_height);
	                
	            }
	        else
	            alert("Please select portion..!");
	    }
	    
	    function saveCropImage(params) {
	    jQuery.ajax({
	        url: params['targetUrl'],
	        cache: false,
	        dataType: "html",
	        data: {
	            action: params['action'],
	            id: jQuery('#hdn-profile-id').val(),
	             t: 'ajax',
	                                w1:params['thumb_width'],
	                                x1:params['x_axis'],
	                                h1:params['thumb_height'],
	                                y1:params['y_axis'],
	                                x2:params['x2_axis'],
	                                y2:params['y2_axis'],
									image_name :jQuery('#image_name').val()
	        },
	        type: 'Post',
	       // async:false,
	        success: function (response) {
	                jQuery('#changePic').hide();
					jQuery('#change-pic').show();
	                jQuery(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
	                
	                jQuery("#avatar-edit-img").attr('src', response);
	                jQuery("#preview-avatar-profile").html('');
	                jQuery("#photoimg").val('');
	        },
	        error: function (xhr, ajaxOptions, thrownError) {
	            alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
	        }
	    });
	    }
		});
	