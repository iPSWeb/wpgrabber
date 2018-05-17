<?php

  class WPGWordPressDB {

    public static function isField($table, $field, $ch = true) {
      global $wpdb;
      static $cache;
      if ($table !== '' and $field !== '') {
        if (!isset($cache[$table]) or !$ch) {
          $cache[$table] = array();
          $sql = 'SHOW COLUMNS FROM `'.esc_sql($table).'`';
          $fields = $wpdb->get_results($sql, ARRAY_A);
          if ($wpdb->last_error != '') {
            WPGErrorHandler::add($wpdb->last_error, __FILE__, __LINE__);
          }
          if (!empty($fields)) {
            foreach ($fields as $f) {
              if (isset($f['Field'])) {
                $cache[$table][] = $f['Field'];
              }
            }
          }
        }
        return in_array($field, $cache[$table]);
      }
      return false;
    }
  }