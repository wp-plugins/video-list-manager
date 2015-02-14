<?php 
	/**
	 * Author: Tung Pham
	 */

	/**
	 * Add css to frondend
	 */
	add_action('wp_enqueue_scripts', 'tntAddFrontEndCSS');
	function tntAddFrontEndCSS()
	{
		if (!is_admin()) {
			$tntOptions = get_option('tntVideoManageOptions');
			$tntSkin 	= $tntOptions['skinColorbox']; 
			
			switch ($tntSkin) {
				case '1':
					wp_enqueue_style('tntColorbox1', TNT_CSS_URL.'/skin1/colorbox.css');
					break;
				case '2':
					wp_enqueue_style('tntColorbox2', TNT_CSS_URL.'/skin2/colorbox.css');
					break;
				case '3':
					wp_enqueue_style('tntColorbox3', TNT_CSS_URL.'/skin3/colorbox.css');
					break;
				case '4':
					wp_enqueue_style('tntColorbox4', TNT_CSS_URL.'/skin4/colorbox.css');
					break;
				case '5':
					wp_enqueue_style('tntColorbox5', TNT_CSS_URL.'/skin5/colorbox.css');
					break;
				default:
					# code...
					break;
			}

			wp_enqueue_style('tntstyle1', TNT_CSS_URL.'/style.css');
		}
	}

	/**
	 * Add javascript to footer of frondend
	 */
	add_action('init', 'tntAddFrontEndJS');
	function tntAddFrontEndJS() {
        if (!is_admin()) {
        	$tntOptions = get_option('tntVideoManageOptions');
        	
        	if($tntOptions['tntJquery'] == 1)
        	{
        		wp_deregister_script('jquery');
				wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', false, '1.8.1', true);
				wp_enqueue_script('jquery');	
        	}

            if($tntOptions['tntColorbox'] == 1)
            {
            	wp_enqueue_script('tntcolorbox', TNT_JS_URL.'/jquery.colorbox-min.js', false, '1.0', true);	
            }

            wp_enqueue_script('tntscript1', TNT_JS_URL.'/custom.js', false, '1.0', true);
        }
    }
	   
	/**
	 * Add css to backend
	 */
	add_action('admin_print_styles', 'tntAddBackEndCSS');
	function tntAddBackEndCSS()
	{
		if (is_admin()) {
			wp_enqueue_style('tntstyleAdmin', TNT_CSS_URL.'/admin.css');		
		}
	}

	/**
	 * Add javascript to footer of backend
	 */
	add_action('init', 'tntAddBackEndJS');
	function tntAddBackEndJS() {
        if (is_admin()) {
        	wp_enqueue_script('tntscriptAdmin1', TNT_JS_URL.'/jquery.validate.js', false, '1.0', true);
            wp_enqueue_script('tntscriptAdmin2', TNT_JS_URL.'/admin.js', false, '1.0', true);
        }
    }

	/**
	 * Template to show videos list
	 * @param 	$argsVideo([0]=>array('videoTitle' => title of Video, 'videoFrame' => iFrame of video))
	 * @return  html 	html of videos list
	 */

	function tntTemplateVideoList($argsList = null, $paginator = null, $columns = 2)
	{	
		$view = "";
		if($argsList != null)
		{
			$view .= '<div class="tntVideoList" width="'.$argsList[0]['videoWidth'].'" height="'.$argsList[0]['videoHeight'].'" rel="'.$columns.'">';
			$i = 1;
			foreach ($argsList as $video)
			{
				if($i % $columns == 1)
				{
					$view .= '<div class="tntVideoItem noML">';	
				}
				else
				{
					$view .= '<div class="tntVideoItem">';
				}
				$view .= '<h3>'. $video['videoTitle'] . '</h3>';
				$view .= '<a href="'.$video['videoEmbed'].'" title="'.$video['videoTitle'].'">';
				$view .= '<img src="'.$video['videoThumb'].'" />';
				$view .= '</a>';
				$view .= '</div>';
				if($i % $columns == 0)
				{
					$view .= '<div class="tntClear"></div>';
				}
				$i++;
			}
			$view .= '<div class="tntClear"></div>';
			$view .= '</div>';	
		}
		$view .= '<div class="pagiWrap">';
		$view .= $paginator;
		$view .= '</div>';
		return $view;
	}
	
	/**
	 * Template to show video item
	 * Author: Tung Pham
	 * @param 	$argsVideo([0]=>array('videoTitle' => title of Video, 'videoFrame' => iFrame of video))
	 * @return  html 	html of videos list
	 */
	function tntTemplateVideoItem($tntVideo = null)
	{	
		$view = "";
		if($tntVideo != null)
		{
			$view .= '<div class="tntVideoSingle">';
			$view .= '<h3>'. $tntVideo['videoTitle'] . '</h3>';
			$view .= $tntVideo['videoFrame'];
			$view .= '</div>';
		}
		return $view;
	}	
?>