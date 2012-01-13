<?php
/* 
Plugin Name: Civic Commons Marketplace
Plugin URI: http://www.walkscore.com/professional/word-press.php
Description:Provides simple shortcodes to embed Civic Commons Marketplace information on your wordpress blog
Version: 0.1
Author: Abhi Nemani
Author URI: http://www.civiccommons.org
License: GPL2
*/


/* USAGE
	Shortcodes: [cc-mkplc]
*/


// [walk-score-map id="ws-id" address="" size="" orientation=""]
add_shortcode( 'cc-mkplc', 'cc_mkplc_sc' );

function cc_mkplc_sc( $atts, $content = null ) {
  
	$default_atts = array(
		'app' => null,
		'height' => "300px",
	);
	
  //get shortcode attributes
	extract( shortcode_atts( $default_atts, $atts ) );
 
  //convert application name to ID
  $url = "http://marketplace.civiccommons.org/api/v1/views/application_api.xml?filters[keywords]=".$app;
  $xml = simplexml_load_file($url);
  $id = $xml->item->nid;

  return "<iframe src='http://50.19.214.65/cc-mkplc-widget/widget.html#" . $id . "' width='610px;' height='" . $height . "' frameborder='0' scrolling='no'></iframe>"; }
  ?>