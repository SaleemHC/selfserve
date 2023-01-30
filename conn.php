<?php
$servername = "localhost";
$username = "publishe_self";
$password = "hcselfserve22";
$dbname = "publishe_selfserve"; 
$connectDB = mysqli_connect($servername,$username,$password,$dbname);
if (!$connectDB){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
// else{
//     echo "success";
// }
?>