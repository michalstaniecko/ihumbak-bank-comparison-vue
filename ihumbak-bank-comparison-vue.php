<?php
/*
 * Plugin Name: iHumbak Bank Comparison Vue
 */


add_action('wp_enqueue_scripts', 'ihumbak_bank_comparison_vue_assets');
function ihumbak_bank_comparison_vue_assets() {
  wp_enqueue_style('ihumbak_bank_comparison_vue_main',plugin_dir_url(__FILE__).'/dist/app.css',false,false,'all');
  wp_enqueue_script('ihumbak_bank_comparison_vue_main_js', plugin_dir_url(__FILE__).'/dist/app.js', false,null,true);
  wp_localize_script('ihumbak_bank_comparison_vue_main_js', 'wp_ajax', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    '_nonce' => wp_create_nonce('any_value_here')
  ));
}

add_shortcode('bank_comparison_vue', 'ihumbak_bank_comparison_vue');

function ihumbak_bank_comparison_vue() {
  $imgPath = plugin_dir_url(__FILE__).'img/';
  return '<div id="app"  ><bank-comparison img-path="'.$imgPath.'"></bank-comparison></div>';
}


include plugin_dir_path(__FILE__).'inc/class-ihumbak-bank-comparison-post_types.php';
include plugin_dir_path(__FILE__).'inc/class-ihumbak-bank-comparison-vue-acf.php';
