<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$q = strtolower($_GET["q"]);
if (!$q) return;

$con = mysql_connect('127.0.0.1:3306', 'root', 'root');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("rf", $con);

$sql="SELECT * FROM ingredients_synonyms WHERE name LIKE '$q%'";

$result = mysql_query($sql);
$result_array = mysql_fetch_array($result);
var_dump($result_array);
mysql_close($con);
?>


