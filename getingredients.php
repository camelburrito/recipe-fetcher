<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
include('helpers.php');

if (!array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)) {
    raise_not_found();
}
if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    raise_not_found();
}

$q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
if (!$q) { echo json_encode(array("error" => "enter a string")); exit(); }

$conn = get_mysql_conn();
$sql="SELECT name FROM ingredients_synonyms WHERE name LIKE '$q%' LIMIT 10";

$result = mysql_query($sql);
$final_array = array();
while ($row = mysql_fetch_array($result)) {
    array_push($final_array, $row["name"]);
}
echo json_encode($final_array);
mysql_free_result($result);
mysql_close($conn);
?>


