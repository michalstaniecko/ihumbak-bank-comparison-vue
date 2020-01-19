<?php

/**
 * Advanced Custom Fields Pro
 */

class Ihumbak_Bank_Comparison_ACF
{
  public function activate_plugin()
  {
// Define path and URL to the ACF plugin.
    define('MY_ACF_PATH', plugin_dir_path(__FILE__) . 'acf/');
    define('MY_ACF_URL', plugin_dir_url(__FILE__) . 'acf/');

// Include the ACF plugin.
    include_once(MY_ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url($url)
    {
      return MY_ACF_URL;
    }

// (Optional) Hide the ACF admin menu item.
    add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    function my_acf_settings_show_admin($show_admin)
    {
      return true;
    }

    add_filter('acf/settings/save_json', 'bank_acf_json_save_point');
    function bank_acf_json_save_point($path)
    {

      $path = plugin_dir_path(__FILE__) . 'acf-json';
      return $path;
    }

    add_filter('acf/settings/load_json', 'bank_acf_json_load_point');
    function bank_acf_json_load_point($paths)
    {
      unset($paths[0]);
      $paths[] = plugin_dir_path(__FILE__) . 'acf-json';
      return $paths;
    }

  }

  public function acf_meta_fields_register()
  {
    register_rest_field('bank',
      'acf',
      array(
        'get_callback' => array('Ihumbak_Bank_Comparison_ACF', 'acf_meta_for_api'),
      ));
  }

  public function acf_meta_for_api($object, $field_name, $request)
  {
    $post_id = $object['id'];

    return array(
      'params' => array(
        'bezplatne_prowadzenie_konta' => get_field('bezplatne_prowadzenie_konta', $post_id),
        'bezplatna_karta' => get_field('bezplatna_karta', $post_id),
        'bezplatne_przelewy' => get_field('bezplatne_przelewy', $post_id),
        'bezplatne_stale_zlecenia' => get_field('bezplatne_stale_zlecenia', $post_id),
        'bezplatne_przelewy_blyskawiczne' => get_field('bezplatne_przelewy_blyskawiczne', $post_id),
        'bezplatne_autoryzacje_sms' => get_field('bezplatne_autoryzacje_sms', $post_id),
        'bezplatne_wyplaty_z_bankomatu' => get_field('bezplatne_wyplaty_z_bankomatu', $post_id),
        'bezplatne_wplaty_we_wplatomacie' => get_field('bezplatne_wplaty_we_wplatomacie', $post_id),
        'bezplatne_polecenia_zaplaty' => get_field('bezplatne_polecenia_zaplaty', $post_id),

      ),
      'benefits' => array(
        'promo' => array(
          'enabled'=>get_field('promocja')['promocja'],
          'description' => get_field('promocja')['opis']
        )
      )
    );
  }
}

add_action('setup_theme', array('Ihumbak_Bank_Comparison_ACF', 'activate_plugin'));
add_action('rest_api_init', array('Ihumbak_Bank_Comparison_ACF', 'acf_meta_fields_register'));
