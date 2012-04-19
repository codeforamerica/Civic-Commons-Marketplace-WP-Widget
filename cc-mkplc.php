<?php
/*
 Plugin Name: Civic Commons Marketplace
 Plugin URI: http://www.civiccommons.org
 Description:Provides simple shortcodes to embed Civic Commons Marketplace information on your wordpress blog.
 Version: 0.2
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

	// Convert application name to ID.
	$url = "http://marketplace.civiccommons.org/api/v1/views/application_api.xml?filters[keywords]=".$app;
	$xml = simplexml_load_file($url);
	// If search terms return numtiple apps, randomize display.
	$key = (count($xml->item) > 1) ? rand(0, (count($xml->item)-1)) : 0;
	$id = $xml->item[$key]->nid;

	return "<iframe src='http://codeforamerica.github.com/cc-mkplc-widget/widget.html#" . $id . "' width='610px;' height='" . $height . "' frameborder='0' scrolling='no'></iframe>";
}

?>