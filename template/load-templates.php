<?php

include "../conn.php";

$sql = "SELECT distinct(template_name) FROM templates";
$result = mysqli_query($connectDB, $sql) or die("SQL Query Failed.");

if(mysqli_num_rows($result) > 0 ){
  $output = mysqli_fetch_all($result, MYSQLI_ASSOC);

  echo json_encode($output);

}else{
  echo "No Record Found.";
}

?>
