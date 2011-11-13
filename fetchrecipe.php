<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// var_dump($_SERVER);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    /* special ajax here */
    header('HTTP/1.0 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

// $q=$_GET["q"];
// 
// $con = mysql_connect('localhost', 'peter', 'abc123');
// if (!$con)
//   {
//   die('Could not connect: ' . mysql_error());
//   }
// 
// mysql_select_db("ajax_demo", $con);
// 
// $sql="SELECT * FROM user WHERE id = '".$q."'";
// 
// $result = mysql_query($sql);
// 
// echo "<table border='1'>
// <tr>
// <th>Firstname</th>
// <th>Lastname</th>
// <th>Age</th>
// <th>Hometown</th>
// <th>Job</th>
// </tr>";
// 
// while($row = mysql_fetch_array($result))
//   {
//   echo "<tr>";
//   echo "<td>" . $row['FirstName'] . "</td>";
//   echo "<td>" . $row['LastName'] . "</td>";
//   echo "<td>" . $row['Age'] . "</td>";
//   echo "<td>" . $row['Hometown'] . "</td>";
//   echo "<td>" . $row['Job'] . "</td>";
//   echo "</tr>";
//   }
// echo "</table>";
// 
// mysql_close($con);
?>


