<?php
define('WPGRABBER_VERSION', '1.0.0');
define('WPGRABBER_CORE_VERSION', '1.0.0');
define('WPGRABBER_PLUGIN_INSTALL_DIR', WPGRABBER_PLUGIN_DIR.'install'.DIRECTORY_SEPARATOR);
define('WPGRABBER_PLUGIN_CORE_DIR', WPGRABBER_PLUGIN_DIR.'core'.DIRECTORY_SEPARATOR);
define('WPGRABBER_PLUGIN_TPL_DIR', WPGRABBER_PLUGIN_DIR.'tmpl'.DIRECTORY_SEPARATOR);

  if (!session_id()) {
    session_start();
  }

  function wpgIsDebug() {
    return is_file(WPGRABBER_PLUGIN_DIR.'debug');
  }

  if (wpgIsDebug()) {
    ini_set('display_errors', true);
    error_reporting(E_ALL ^ E_NOTICE);
  }

  function wpgPlugin() {
    return 'WPGPlugin';
  }

  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGPlugin.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGErrorHandler.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGHelper.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGTable.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGTools.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGWordPressDB.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGrabberCore.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGrabberWordPress.php');
  require_once (WPGRABBER_PLUGIN_CORE_DIR.'WPGrabberWPOptions.php');
  call_user_func(array(wpgPlugin(), 'load'));