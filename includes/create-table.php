<?php 
/**
 * Create Table
 * 
 * Create tables for plugins
 *
 * Author: Tung Pham
 */

	/**
	 * Create table : tnt_videos
	 */
	function tnt_install_videos_table(){
		global $wpdb;

		$tableName = $wpdb->prefix."tnt_videos";
		$sql = "CREATE TABLE IF NOT EXISTS $tableName (
			  video_id int(11) NOT NULL AUTO_INCREMENT,
			  video_title varchar(255) NOT NULL,
			  video_link_type varchar(255) NOT NULL,
			  video_link varchar(255) NOT NULL,
			  video_cat int(11) NOT NULL DEFAULT '1',
			  video_status tinyint(4) NOT NULL DEFAULT '1',
			  video_order int(11) NOT NULL DEFAULT '100',
			  PRIMARY KEY (video_id),
			  KEY video_link_type (video_link_type),
			  KEY video_cat (video_cat),
			  KEY video_order (video_order)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql); 
	}

	/**
	 * Create table : tnt_videos_cat
	 */
	function tnt_install_videos_cat_table(){
		global $wpdb;

		$tableName = $wpdb->prefix."tnt_videos_cat";
		$sql = "CREATE TABLE IF NOT EXISTS $tableName (
			  video_cat_id int(11) NOT NULL AUTO_INCREMENT,
			  video_cat_title varchar(255) NOT NULL,
			  video_cat_parent_id int(11) NOT NULL DEFAULT '0',
			  PRIMARY KEY (video_cat_id),
			  KEY video_cat_parent_id (video_cat_parent_id)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql); 
	}

	/**
	 * Create table : tnt_videos_type
	 */
	function tnt_install_videos_type_table(){
		global $wpdb;

		$tableName = $wpdb->prefix."tnt_videos_type";
		$sql = "CREATE TABLE IF NOT EXISTS $tableName (
			  video_type_id int(11) NOT NULL AUTO_INCREMENT,
			  video_type_title varchar(255) NOT NULL,
			  PRIMARY KEY (video_type_id)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql); 
	}

	/**
	 * Check if ID exists in tableName
	 *
	 * @param 	string 		tableName 	name of table
	 * @param 	string 		fieldID 	name of field which contain ID
	 * @param 	int 		fieldValue 	value of field
	 * @return 	bool 		if ID = NULL ==> False
	 *						else True
	 */
	function tnt_check_id_exists($tableName, $fieldID, $fieldValue )
	{
		$check = true;
		global $wpdb;
		$id = $wpdb->get_var( $wpdb->prepare( "SELECT $fieldID FROM $tableName WHERE $fieldID = $fieldValue;" ) );
		if($id == null){
			$check = false;
		}
		return $check;
	}

	/**
	 * Insert data into database: tnt_videos_type
	 */
	function tnt_install_data_videos_type_table(){
		global $wpdb;
		$tableName = $wpdb->prefix."tnt_videos_type";
		$type_title = "Youtube";
		$firstID = tnt_check_id_exists($tableName, "video_type_id", 1);
		if($firstID == false)
		{
			$rows_affected = $wpdb->insert( $tableName, array( 'video_type_title' => $type_title) );
		}
	}

	/**
	 * Insert data into database: tnt_videos_cat
	 */
	function tnt_install_data_videos_cat_table(){
		global $wpdb;
		$tableName = $wpdb->prefix."tnt_videos_cat";
		$cat_title = "Uncategorized";
		$cat_parent_id = 0;
		$firstID = tnt_check_id_exists($tableName, "video_cat_id", 1);
		if($firstID == false)
		{
			$rows_affected = $wpdb->insert( $tableName, array( 'video_cat_title' => $cat_title, 'video_cat_parent_id' => $cat_parent_id ) );	
		}
	}
?>