<?php
/*
Plugin Name: ZOCIAL
Plugin URI: http://www.agnelwaghela.site90.net/zocial
Description: Good buttons make good neighbours. The <b>Ultimate</b> plugin to add <b>ZOCIAL</b> (SOCIAL) icons to your wordpress site. Add Either ICONS or Text with ICONS. You decide the text, just <b>one shortcode</b> for all the social networks. <b>[zocial]</b>. 42 CSS3 FONT-FACE VECTOR ICON BUTTONS.
Version: 1.0
Author: Agnel Waghela
Author URI: http://www.agnelwaghela.site90.net/
*/

/*  Copyright YEAR  Agnel Waghela  (email : agnelwaghela@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	
	class Zocial {
		
		var $pluginUrl = '';
		var $pluginPath = '';
		var $title = 'zocial';
		var $slug = 'zocial_admin_page';
		var $version = '1.0';
		
		function Zocial() {
			$this->pluginUrl = plugin_dir_url( __FILE__ );
			$this->pluginPath = plugin_dir_path( __FILE__ );
			$this->actions();
		}
		
		function actions() {
			
			add_action('admin_head', array( &$this, 'zocial_admin') );
			add_action('wp_head', array( &$this, 'zocial_wp_head' ) );
			add_action('admin_menu', array( &$this, 'zocial_admin_menu_page' ) );
			add_filter("plugin_action_links", array( &$this, 'plugin_action_links'), 10, 2 );
			add_shortcode('zocial', array( &$this, 'zocial_shortcode' ) );
		}
		
		function zocial_admin() {
			if( is_admin() && (isset($_GET) && $_GET['page'] == 'zocial_admin_page')) {
				//wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
				wp_enqueue_script( array('jquery',"jquery-ui-sortable",'jquery-ui-tabs', 'jquery-ui-button') );
				wp_enqueue_script( 'zocial_qtip_js', $this->pluginUrl. 'js/jquery.qtip.min.js',array('jquery'), 1.0, false);
				wp_enqueue_script( 'zocial_admin_js', $this->pluginUrl.'js/zocial.admin.js', array( 'jquery' ), 1.0, true );
				
				//wp_enqueue_style( name of stylesheet, url, dependencies, version, all/screen/handheld/print );
				wp_enqueue_style( 'zocial_admin_css', $this->pluginUrl.'css/zocial.admin.css', null, 1.0, 'all' );
				wp_enqueue_style( 'zocial_css', $this->pluginUrl.'css/zocial.css', null, 1.0, 'all' );
				wp_enqueue_style( 'zocial_qtip', $this->pluginUrl.'css/jquery.qtip.min.css', array(), 1.0 );
				
			}
		}
		
		function zocial_wp_head() {
			wp_enqueue_style( 'zocial', $this->pluginUrl.'css/zocial.css', null, $this->version, 'all' );
		}
		
		function zocial_admin_menu_page() {
			if( is_admin() ) {
				// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
				add_menu_page( $this->title, $this->title, 8, $this->slug, array( &$this, 'zocial_admin_page' ), $this->pluginUrl.'css/zocial16x16.png');
			}
		}
		
		function plugin_action_links($links, $file) {
			if (dirname($file) == $this->title) {
				 $links[] = '<a href="admin.php?page='.$this->slug.'#zocial_doc">Docs</a>';
			}
			return $links;
		}
		
		function zocial_shortcode( $atts, $content = 'Sign in with' ) {
			extract( shortcode_atts( array(
					's' 	  => '',
					'href'	  => '#',
					'icon'	  => 'false'
			), $atts ) );
			
			if ( $icon != 'true' ) {
				$c =  '<a href="'.$href.'" class="zocial '.$s.'"><span>'.$content.'</span></a>';
			}
			else {
				$c = '<a href="'.$href.'" class="zocial icon '.$s.'"><span>Sign in with'.$s.'</span></a>';
			}
			
			return $c;
		}
		
		function zocial_admin_page() {
			$author_media_links = array(
			'facebook'     => 'http://www.facebook.com/agnelwaghela',
			'twitter'      => 'http://www.twitter.com/agnel_waghela',
			'googleplus'   => 'https://plus.google.com/u/0/102335655605828567299',
			'github'       => 'https://github.com/agnel',
			'wordpress'    => 'http://www.agnelwaghela.wordpress.com/',
			'dribbble'     => 'http://dribbble.com/agnelwaghela',
			'tumblr'       => 'http://www.agnelwaghela.tumblr.com/',
			'pinterest'    => 'http://www.pinterest.com/agnelwaghela',
			'myspace'      => 'http://www.myspace.com/agnelwaghela'
			);
			
			$zocialServices = array(
					'facebook' 			=> 'Facebook.com',
					'googleplus'		=> 'plus.google.com',
					'twitter'			=> 'Twitter.com',
					'linkedin'			=> 'Linkedin.com',
					'dropbox'			=> 'Dropbox.com',
					'evernote'			=> 'Evernote.com',
					'forrst'			=> 'Forrst.com',
					'dribbble'			=> 'Dribbble.com',
					'cloudapp'			=> 'Cloudapp',
					'github'			=> 'Github.com',
					'spotify'			=> 'Spotify.com',
					'instapaper'		=> 'Instapaper.com',
					'soundcloud'		=> 'Soundcloud.com',
					'tumblr'			=> 'Tumblr.com',
					'smashing'			=> 'Smashingmagazine.com',
					'itunes'			=> 'iTunes.com',
					'appstore'			=> 'apple.com/mac/app-store/',
					'macstore'			=> 'store.apple.com',
					'android'			=> 'Android.com',
					'paypal'			=> 'Paypal.com',
					'amazon'			=> 'Amazon.com',
					'skype'				=> 'Skype.com',
					'lastfm'			=> 'Lastfm.com',
					'yelp'				=> 'Yelp.com',
					'foursquare'		=> 'Foursquare.com',
					'wikipedia'			=> 'Wikipedia.org',
					'disqus'			=> 'Disqus.com',
					'intensedebate'		=> 'Intensedebate.com',
					'google'			=> 'Google.com',
					'gmail'				=> 'Gmail.com',
					'vimeo'				=> 'Vimeo.com',
					'scribd'			=> 'Scribd.com',
					'youtube'			=> 'Youtube.com',
					'wordpress'			=> 'Wordpress.org',
					'songkick'			=> 'Songkick.com',
					'posterous'			=> 'Posterous.com',
					'eventbrite'		=> 'Eventbrite.com',
					'flattr'			=> 'Flattr.com',
					'plancast'			=> 'Plancast.com',
					'yahoo'				=> 'Yahoo.com',
					'ie'				=> 'windows.microsoft.com',
					'meetup'			=> 'Meetup.com',
					'openid'			=> 'Openid',
					'html5'				=> 'w3.org',
					'aol'				=> 'AOL',
					'guest'				=> 'Guset Icon',
					'creativecommons'	=> 'Creative Commons',
					'rss'				=> 'RSS',
					'chrome'			=> 'Chrome Icon',
					'eventasaurus'		=> 'Eventasaur.us',
					'weibo'				=> 'Weibo',
					'plurk'				=> 'Plurk',
					'grooveshark'		=> 'Grooveshark',
					'blogger'			=> 'Blogger.com',
					'viadeo'			=> 'Viadeo.com',
					'pinterest'			=> 'Pinterest.com',
					'podcast'			=> 'Podcast',
					'fivehundredpx'		=> 'Fivehundredpx',
					'bitcoin'			=> 'Bitcoin',
					'ninetyninedesigns'	=> 'Ninetyninedesigns',
					'quora'				=> 'Quora',
					'pinboard'			=> 'Pinboard',
					'stumbleupon'		=> 'Stumbleupon.com',
					'myspace'			=> 'Myspace.com',
					'windows'			=> 'Windows'
			);
			include $this->pluginPath.'options.php';
		}
		
	}
	
new Zocial();	
?>