=== Video List Manager ===
Concontributors: thanhtungtnt 
Donate link: http://videolistmanager.blogspot.com/
Tags: video, youtube, vimeo, dailymotion, video list, video manager, video list manager 
Requires at least: 3.0.1
Tested up to: 3.5
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add, edit, delete and manage YOUTUBE, VIMEO, DAILYMOTION videos, separated by categories and display them by category, fit all layouts.

== Description ==

Video List Manager is the video list plugin for WordPress. It helps you to add, edit, delete and manage YOUTUBE, VIMEO, DAILYMOTION videos, separated by categories and display them by category automaticly.

Features:

* Support Youtube, Vimeo, Dailymotion Video
* Add/Edit/Delete/Manage Video 
* Add/Edit/Delete/Manage Category
* Using jquery colorbox to show video, support 5 colorbox skins.
* Fit all layouts

Some shortcodes you need to know:

To show a video item you use this shordcode in your post/page: [tnt_video id=](id: video id)

You also can use some following attributes to custom the width and height of video:

* width	: width of video in list
* height	: height of video in list
* Ex: [tnt_video id=1 width="600" height="400"] 

To Show a videos list by category id you use this shordcode in your post/page: [tnt_video_list id=] (id: category id of videos list)

You also can use some following attributes to custom videos list:

* col  	 : numbers of column you want to show. Default: 2
* limit	 : numbers of video you want show per page. Default: 4
* width	 : width of video in list (Unit: px). Default: 480 
* height : height of video in list (Unit: px). Default: 360
* order  : sort the results by: Video ID (keyword: videoid), Adding Date (keyword: addingdate), Editing Date (keyword: editingdate), Alphabet (keyword: alphabet) or Order Number (keyword: ordernumber). Default: Adding Date 
* orderby: ascending or descending (keywords: asc, desc). Default: desc
* Ex: [tnt_video_list id="1" col="4" limit="10" width="400" height="300" order="alphabet" orderby="asc"]

Note: Need to enable the permalink (Settings --> Permalinks) to run this plugin

Tutorial: http://www.youtube.com/watch?v=R_0BmfKC1Jw

== Installation ==

1. Download, install, and activate the Video List Manager plugin.

2. From your WordPress Dashboard, go to Video List Manager > Add Video. To add cateogory, go to Video List Manager > Add Cateogory

3. Go to a post/page, use shortcodes. 

== Frequently Asked Questions ==

No Frequently Asked Questions

== Screenshots ==

1. Video Manager
2. Add Video
3. Categories
4. Settings

== Changelog ==

= 1.0 =
* The first version
* Support youtube video

= 1.1 =
* Add multi video to a category
* Support Vimeo video
* Add validate to "add video form", "edit video form", "edit category form", "setting form" 

= 1.2 =
* Fix bug add single video
* Fix bug update database
* Add remove button to video item

= 1.3 =
* Support Dailymotion Video

= 1.4 =
* fix bug pagination
* allow to sort results by many ways
* add created date, modified date

== Upgrade Notice ==

= 1.0 =
* No notice

= 1.1 =
* About database: If the plugin don't auto insert video type "Vimeo", you should insert manually a Vimeo type in table "wp_tnt_videos_type" 

= 1.2 =
* No notice

= 1.3 =
* No notice

= 1.4 =
* No notice

== Arbitrary section ==

CREDIT
Copyright:
Tung Pham 2012

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
       
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
   
You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

SHORTCODES EXAMPLE: 
To show a video list with category id = 4 : 
[tnt_video_list id=4] (default: 2 columns, 4 videos per page, width: 480, height: 360)

To show a video list with category id = 4, 3 columns, 10 videos per page, width: 520px, height: 420px : 
[tnt_video_list id=4 col="3" limit="10" width="520" height="420"]

To show a video with video id = 3, width: 400, height: 300 
[tnt_video id=3 width="400" height="300"]