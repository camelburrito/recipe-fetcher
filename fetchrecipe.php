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

$ingredients_str = filter_input(INPUT_GET, 'ingredients', FILTER_SANITIZE_STRING);
if (!$ingredients_str) { 
    echo json_encode(array("error" => "no ingredients found")); 
    exit(); 
}
$ingredients = explode(",", $ingredients_str);

# get ingredients ids from db

$conn = get_mysql_conn();
$sql = 'SELECT DISTINCT(ingredient_id) FROM ingredients_synonyms WHERE name IN ("'.implode('", "', array_map('mysql_real_escape_string', $ingredients)).'")';

$result = mysql_query($sql);
$ingredients_array = array();
while ($row = mysql_fetch_array($result)) {
    array_push($ingredients_array, $row["ingredient_id"]);
}
mysql_free_result($result);

# now get recipes from these ingredients
$sql = 'SELECT recipes FROM ingredients WHERE id in ('.implode(",", $ingredients_array).')';
$result = mysql_query($sql);
$intermediate_recipes_array = array();
while ($row = mysql_fetch_array($result)) {
    array_push($intermediate_recipes_array, json_decode($row["recipes"]));
}

$recipe_ids = array_values(call_user_func_array('array_intersect',$intermediate_recipes_array));

# now get recipes and display them
echo json_encode($recipe_ids);
mysql_free_result($result);
mysql_close($conn);
?>


