<?php 
/**
 * Register a shortcode
 */
add_shortcode('tnt_video_list', 'tntSCVideoList');
add_shortcode('tnt_video', 'tntSCVideo');

/**
 * Function get embed code from youtube link
 */
function tntGetYoutubeEmbedLink($link)
{
	$youtubeEmbedLink = 'http://www.youtube.com/embed/';
	$l = explode('?v=', $link);
	$embedCode = $l[1];
	$youtubeEmbedLink .= $embedCode;
	return $youtubeEmbedLink;
}

/**
 * Function get thumb link from youtube link
 */
function tntGetYoutubeThumbLink($link)
{
	$l = explode('?v=', $link);
	$embedCode = $l[1];
	$youtubeThumbLink = 'http://img.youtube.com/vi/'.$embedCode.'/mqdefault.jpg';
	return $youtubeThumbLink;
}


/**
 * Callback function for shortcode [tnt_video_list]
 */
function tntSCVideoList($attr){
	$tntOptions = get_option('tntVideoManageOptions');

	//Get cat ID
	$catID = $attr['id'];
	
	//Get column
	$columnOption = $tntOptions['columnPerRow'];
	$columns = (isset($attr['col'])) ? $attr['col'] : $columnOption;

	//Get video width
	$videoWidth = $tntOptions['videoWidth'];
	$vidWidth 	= (isset($attr['width'])) ? $attr['width'] : $videoWidth;

	//Get video height
	$videoHeight = $tntOptions['videoHeight'];
	$vidHeight 	 = (isset($attr['height'])) ? $attr['height'] : $videoHeight;	 

	//Get Limit
	$limitOption = $tntOptions['limitPerPage'];
	$numLimit    = (isset($attr['limit'])) ? $attr['limit'] : $limitOption;

	//Get videos by catID
	$args = array('catID' => $catID, 'isPublish' => 1);
	$videoList = TNT_Video::tntGetVideos($args); 

	//Get all information for pagination
	$items = count($videoList);
	if($items > 0) 
	{
        $p = new TNT_Pagination();
        $p->items($items);
        $p->limit($numLimit); // Limit entries per page
        $p->target($_SERVER["REQUEST_URI"]); 
        $p->calculate(); // Calculates what to show
        $p->parameterName('paged');
        $p->adjacents(1); //No. of page away from the current page
        
        $pageMix = explode('/page/', $_SERVER["REQUEST_URI"]);
        $page = (isset($pageMix[1])) ? substr($pageMix[1], 0, 1) : 1;
        $p->page = ($page != null) ? $page : 1;
        $p->currentPage($p->page);

        //Query for limit paging
        $limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
	         
	} else {
	    echo "No Record Found! Category ID was not existed!"; exit();
	}

	//Get videos by options
	$args = array('catID' => $catID, 'isPublish' => 1, 'limitText' => $limit, 'orderBy' => 'video_order', 'order' => 'ASC');
	$videoListLimit = TNT_Video::tntGetVideos($args);

	//Show template
	$vListToShow = "";
	foreach ($videoListLimit as $video)
	{
		$v = "";
		$videoTypeTitle = $video->video_type_title;
		$linkEmbed = "";
		$thumbImg = "";
		switch($videoTypeTitle)
		{
			case "Youtube" :
				$linkEmbed = tntGetYoutubeEmbedLink($video->video_link); 
				$thumbImg = tntGetYoutubeThumbLink($video->video_link);
				break;			
			default:
				break;
		}
		$v['videoTitle'] 	= $video->video_title;
		$v['videoThumb'] 	= $thumbImg;
		$v['videoUrl'] 		= $video->video_link;			
		$v['videoEmbed'] 	= $linkEmbed;
		$v['videoWidth'] 	= $vidWidth;
		$v['videoHeight'] 	= $vidHeight;
		$vListToShow[] = $v;
	}	

	$tntPagi = $p->getOutput();

	$view = tntTemplateVideoList($vListToShow, $tntPagi, $columns);
	return $view;
}

/**
 * Callback function for shortcode [tnt_video]
 */
function tntSCVideo($attr){
	//Get video ID
	$videoID = (int)$attr['id'];

	//Get width
	$videoWidth = (isset($attr['width'])) ? $attr['width'] : 400; 

	//Get height
	$videoHeight = (isset($attr['height'])) ? $attr['height'] : 300; 

	//Get video by videoID
	$args = array('videoID' => $videoID, 'isPublish' => 1);
	$video = TNT_Video::tntGetVideos($args);
	if($video)
	{
		//Show template
		$vShow = "";
		foreach ($video as $vid)
		{
			$linkEmbed = tntGetYoutubeEmbedLink($vid->video_link);
			$vShow['videoTitle'] = $vid->video_title;
			$vShow['videoFrame'] = '<iframe width="'.$videoWidth.'" height="'.$videoHeight.'" src="'.$linkEmbed.'" frameborder="0" allowfullscreen></iframe>'; 
		}

		$view = tntTemplateVideoItem($vShow);	
	}
	else
	{
		$view = "No Video ID found";
	}
	
	return $view;
}

 ?>