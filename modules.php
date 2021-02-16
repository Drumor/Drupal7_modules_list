<?php
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
require_once DRUPAL_ROOT . '/includes/common.inc';
require_once DRUPAL_ROOT . '/includes/file.inc';
require_once DRUPAL_ROOT . '/includes/module.inc';
require_once DRUPAL_ROOT . '/includes/ajax.inc';
require_once DRUPAL_ROOT . '/includes/install.inc';

// We prepare only a minimal bootstrap. This includes the database and
// variables, however, so we have access to the class autoloader registry.
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

// This must go after drupal_bootstrap(), which unsets globals!
global $conf;


$files = drupal_system_listing('/\.module$/', 'modules', 'name', 0);

//system_get_files_database($files, 'module');

ksort($files);

$core_installed = array();

foreach ($files as $info) {
  $module = new stdClass();
  $module->name = $info->name;
  $module->version = "".drupal_get_installed_schema_version($module->name);
  $core_installed[] = $module;
  //echo $core_installed;
}

//print "Installed Core Modules: " . join(", ", $core_installed) . "\n\n";

$myJSON = json_encode($core_installed);

echo $myJSON;
?>
