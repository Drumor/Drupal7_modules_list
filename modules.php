<?php
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
require_once DRUPAL_ROOT . '/includes/common.inc';
require_once DRUPAL_ROOT . '/modules/update/update.module';

// We prepare only a minimal bootstrap. This includes the database and
// variables, however, so we have access to the class autoloader registry.
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

// This must go after drupal_bootstrap(), which unsets globals!
global $conf;

// Array of data about available releases, keyed by project shortname.
$available = update_get_available();
// An array of installed projects with current update status information.
$projects_with_update_status = update_calculate_project_data($available);

foreach($projects_with_update_status as $module_name => $value) {
    if($value["existing_version"] !==  $value["latest_version"]){
        $result[] = array("name" => $module_name, "installed_version" => $value["existing_version"], "latest_version" => $value["latest_version"]);
    }
    
}
header('Content-Type: application/json');
echo json_encode($result);
?>
