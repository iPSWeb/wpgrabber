<?php
/**
@package WPGrabber
Plugin Name: WPGrabber
Plugin URI: https://github.com/iPSWeb/wpgrabber
Description: WordPess Grabber plugin для автонаполнения вашего сайта контентом
Version: 1.0.0 (17.05.2018)
Author: PSWeb - GrabTeam (close)
Author URI: https://psweb.ru
*/
  if (defined('WPGRABBER_VERSION')) {
    die('На сайте активирован плагин WPGrabber версии '.WPGRABBER_VERSION.'. Пожалуйста, деактивируйте его перед активацией данного плагина.');
  }
  define('WPGRABBER_VERSION', '1.0.0');
  define('WPGRABBER_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
  define('WPGRABBER_PLUGIN_URL', plugin_dir_url( __FILE__ ));
  define('WPGRABBER_PLUGIN_FILE', __FILE__);
  require WPGRABBER_PLUGIN_DIR.'init.php';
?>