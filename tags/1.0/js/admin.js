jQuery(document).ready(function($){
	//Set width for each element .tntVideoItem
	var tntMenuUl = $('li.toplevel_page_tnt_video_manage_page .wp-submenu .wp-submenu-wrap ul');
	tntMenuUl.find('li').eq(2).css('display', 'none');
	tntMenuUl.find('li').eq(3).css('display', 'none');
	tntMenuUl.find('li').eq(6).css('display', 'none');
	tntMenuUl.find('li').eq(7).css('display', 'none');
	tntMenuUl.find('li').eq(10).css('display', 'none');
	tntMenuUl.find('li').eq(11).css('display', 'none');
});	