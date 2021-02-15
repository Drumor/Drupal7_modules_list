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
  $filename = $info->filename;
  $name = $info->name;
  $status = $info->status;

  $contrib = strpos($filename, "sites/all/modules/") === 0;
  $core_installed[] = $name." (".drupal_get_installed_schema_version($name).")";
}

print "Installed Core Modules: " . join(", ", $core_installed) . "\n\n";
?>
