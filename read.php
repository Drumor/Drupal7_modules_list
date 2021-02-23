<?php
$json = file_get_contents('https://example.url/modules.php');
$obj = json_decode($json);

foreach($obj as $value){
    echo json_encode($value);
}
?>
