jQuery(document).ready(function($){
	//Set width for each element .tntVideoItem
	var tntMenuUl = $('li.toplevel_page_tnt_video_manage_page .wp-submenu .wp-submenu-wrap ul');
	tntMenuUl.find('li').eq(2).css('display', 'none');
	tntMenuUl.find('li').eq(3).css('display', 'none');
	tntMenuUl.find('li').eq(6).css('display', 'none');
	tntMenuUl.find('li').eq(7).css('display', 'none');
	tntMenuUl.find('li').eq(10).css('display', 'none');
	tntMenuUl.find('li').eq(11).css('display', 'none');

	var tntInfoVideoTable = '<table class="infoVideo borderDB form-table">';
	tntInfoVideoTable += '<tbody><tr valign="top">';
	tntInfoVideoTable += '<th scope="row"><label for="vTitle">Title</label></th>';
	tntInfoVideoTable += '<td><input type="text" class="required" size="50" name="vTitle[]"></td>';
	tntInfoVideoTable += '</tr>';
	tntInfoVideoTable += '<tr valign="top">';
	tntInfoVideoTable += '<th scope="row"><label for="vLink">Link</label></th>';
	tntInfoVideoTable += '<td><input type="url" class="required" size="50" name="vLink[]"></td>';
	tntInfoVideoTable += '</tr>';
	tntInfoVideoTable += '<tr valign="top">';
	tntInfoVideoTable += '<th scope="row"><label for="vStatus">Status</label></th>';
	tntInfoVideoTable += '<td>';
	tntInfoVideoTable += '<select name="vStatus[]">';
	tntInfoVideoTable += '<option value="1">Published</option>';
	tntInfoVideoTable += '<option value="0">Unpublished</option>';
	tntInfoVideoTable += '</select>';
	tntInfoVideoTable += '</td>';
	tntInfoVideoTable += '</tr>';
	tntInfoVideoTable += '<tr>';
	tntInfoVideoTable += '<th scope="row"><label for="vOrder">Order Number</label></th>';
	tntInfoVideoTable += '<td><input type="text" class="required digits" size="3" name="vOrder[]" value="100"></td>';
	tntInfoVideoTable += '</tr>';
	tntInfoVideoTable += '<tr>';
	tntInfoVideoTable += '<th scope="row"></th>';
	tntInfoVideoTable += '<td><a href="#" class="removeVideoItem button-highlighted title="Remove Video Item">Remove</a></td>';
	tntInfoVideoTable += '</tr>';
	tntInfoVideoTable += '</tbody></table>';

	var tntVideoMessageError = '<p>Errors! Please check again infos you enter <br />';
	tntVideoMessageError += '- Video title is not empty <br />';
	tntVideoMessageError += '- Video link is not empty and must be link format (ex: http://www.youtube.com/watch?v=9bZkp7q19f0) <br />';
	tntVideoMessageError += '- Order is not empty and must be digits</p>';

	$('.addMoreVideo').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$('.infoVideoWrapper').append(tntInfoVideoTable);
	});

	$('.removeVideoItem').live('click', function(){
		$(this).parent().parent().parent().parent().remove();
	});

	$("#addVideoForm").validate();
	var validator = $("#addVideoForm").bind("invalid-form.validate", function() {
		$(".errorContainer").html(tntVideoMessageError);
		$(".errorContainer").addClass("dpb");
	}).validate({
		debug: true,
		errorElement: "em",
		errorContainer: $(".errorContainer")
	});

	$('#editVideoForm').validate({
		rules:{
			vTitle: {
				required: true
			},
			vLink: {
				required: true,
				url: true
			},
			vOrder: {
				required: true,
				digits: true
			}
		},
		messages:{
			vTitle: {
				required: "Please enter video title"
			},
			vLink: {
				required: "Please enter video link",
				url: "Must be link format"
			},
			vOrder: {
				required: "Please enter order number"
			}
		}
	});

	$('#editVideoCatForm').validate({
		rules:{
			catTitle : "required"
		},
		messages:{
			catTitle :{
				required: "Please enter category title"
			}
		}
	});

	$('#optionVideoForm').validate({
		rules:{
			videoLimit:{
				required: true,
				digits: true
			},
			videoLimitAdmin:{
				required: true,
				digits: true
			},
			videoColumn:{
				required: true,
				digits: true
			},
			videoWidth:{
				required: true,
				digits: true
			},
			videoHeight:{
				required: true,
				digits: true
			}
		}
	});
});	