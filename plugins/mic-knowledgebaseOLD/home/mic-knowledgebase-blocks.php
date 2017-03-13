<?php

//Load Stylesheet
function mic_knowledgebase_stylesheet() {
    $plugin_url = plugin_dir_url( __FILE__);

    wp_enqueue_style( 'mic-knowledgebase-stylesheet', $plugin_url . '../assets/css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'mic_knowledgebase_stylesheet' );


//Load Scripts
function mic_knowledgebase_scripts() {
	$plugin_url = plugin_dir_url(__FILE__);
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'mic-knowledgebase-script', $plugin_url . '../assets/js/boxes.js', jquery, $in_footer );
}
add_action( 'wp_enqueue_scripts', 'mic_knowledgebase_scripts' );
