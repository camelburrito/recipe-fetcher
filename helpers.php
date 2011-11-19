<?php
require_once('config.php');

function raise_not_found() {
    header('HTTP/1.0 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

function get_mysql_conn() {
    global $conf;
    $conn = mysql_connect($conf["db_host"], $conf["db_username"], 
                          $conf["db_password"]);
    if (!$conn) { die('Could not connect: ' . mysql_error()); }
    mysql_select_db($conf["db_name"], $conn);
    return $conn;
}

?>
