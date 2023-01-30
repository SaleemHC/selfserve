<?php
include "conn.php";
 $autopassword="";
  $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $charCount = strlen($characters);
//   echo $characters[0];
  for($i=0;$i<8;$i++){
    $autopassword.= substr($characters,rand(0,$charCount-1),1);
  }
    // echo $autopassword;
  $sqlpassword = "SELECT DISTINCT password FROM login";
  $resultpassword = mysqli_query($conn,$sqlpassword);
  while($row = mysqli_fetch_array($resultpassword))
        {
           if($row['password'] === $autopassword){
              echo "password is their" ;
              header("Refresh:0");//refresh
            }}
// echo $autopassword;


if(isset($_POST['submit'])){
  $username=$_POST['username'];
  
// if(isset($_POST) & !empty($_POST)){
//   $username1= mysqli_real_escape_string($conn,$_POST['username'] );
//     $sql="";
//     $result=mysqli_query($conn, $sql);
//     $count=mysqli_num_rows($result);
//     if($count>0)
//     {
//         echo '<div style="color:red;">' .$username1. 'is not available</div>';
//     }
//     else
//       {
//         echo '<div style="color:green;">' .$username1. 'is not available</div>';
//     }
// }
  $name=$_POST['name'];
  $phoneno=$_POST['phoneno'];
  $password=password_hash($autopassword, PASSWORD_DEFAULT);
  Echo "<h1 style='color:red;font-size:18px;position:absolute;top:473px;left:996px;'>success.</h1>";
  $count=1;
  $email=$_POST['email'];
  
  $abc=explode(",",$email);
 for($f=0; $f<count($abc); $f++ ){
    ${"sql".$f}="INSERT INTO `login` (`client_name`,`name`,  `email`, `number`, `password` ) VALUES ('$username', '$name', '$abc[$f]', '$phoneno', '$password')";

  ${"result".$f}=mysqli_query($connectDB,  ${"sql".$f});
   header("location: login.php");
 }
  
  
$to = $email . ", sapna.g@hockeycurve.com";
    $message = "Hello " . $username . ", <br> \r\n\r\n";
$message .= "Your Mail ID-  "; 

 for($e=0; $e<count($abc); $e++ ){
     
   $message .=  $abc[$e] . " <br>  \r\n\r\n";
}

    $message .= "Your Password Is-  " . $autopassword . " <br><br> \r\n\r\n";
     $message .="Thanks & Regards <br>";
    $message .="Hockey Curve";
     $subject ="Registration of Client";
    $header = "From:bizops@hockeycurve.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
                 $header .= "Content-type: text/html\r\n";
                     $retval = mail ($to,$subject,$message,$header);
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.form-container {
    display:flex;
            justify-content:center;
            flex-direction:column;
            align-items:center;
            height:592px;
        }

label {

  text-transform: uppercase;
}


input {
  /* background: white; */
  font-size: 14px;
  display: block;
  padding: 10px 30px 10px 5px;
  margin: 5px 0 20px;
  border: 2px solid black;
  border-radius:5px;
  /* border-bottom: 2px solid grey; */
  font-size:16px;
            width:300px;
            height:20px;
}

.button {
  background: #66cc99;
  border: 0;
 padding: 10px 15px;
   margin-left: 80px;
  color: white;
  text-transform: uppercase;
  text-align:center;
  font-size: 13px;
  height:40px;
  width:200px;
}

/* progress bar */
.multi-steps > li.is-active ~ li:before,
.multi-steps > li.is-active:before {
  content: counter(stepNum);
  font-family: inherit;
  font-weight: 700;
}
.multi-steps > li.is-active ~ li:after,
.multi-steps > li.is-active:after {
  background-color: #ededed;
}

.multi-steps {
  display: table;
  table-layout: fixed;
  width: 85%;
}
.multi-steps > li {
  counter-increment: stepNum;
  text-align: center;
  display: table-cell;
  position: relative;
  color: tomato;
}
.multi-steps > li:before {
  content: "";
  content: "✓;";
  content: "𐀃";
  content: "𐀄";
  content: "✓";
  display: block;
  margin: 0 auto 4px;
  background-color: #fff;
  width: 36px;
  height: 36px;
  line-height: 32px;
  text-align: center;
  font-weight: bold;
  border-width: 2px;
  border-style: solid;
  border-color: tomato;
  border-radius: 50%;
}
.multi-steps > li:after {
  content: "";
  height: 2px;
  width: 100%;
  background-color: tomato;
  position: absolute;
  top: 16px;
  left: 50%;
  z-index: -1;
}
.multi-steps > li:last-child:after {
  display: none;
}
.multi-steps > li.is-active:before {
  background-color: #fff;
  border-color: tomato;
}
.multi-steps > li.is-active ~ li {
  color: #808080;
}
.multi-steps > li.is-active ~ li:before {
  background-color: #ededed;
  border-color: #ededed;
}

 </style>
</head>



<body>

  <div class="form-container">
        <ul class="list-unstyled multi-steps">
    <li class="is-active">Registration form</li>
   <li>Login</li>
    <li>Campaign information</li>
    <li>select template</li>
    <li>Upload assets</li>
    <li>Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
  <h1>Registration form</h1>
    <form name="registerForm" method="post">
      
      <label for="UserName">Client-Name *</label>
      <input type="text" id="username" name="username" placeholder="Enter Name" required/>
    <span id = "usernameloading" style="color:red"> </span>
     <span id = "usernameresult" style="color:red"> </span>
      <label for="Name">Name *</label>
      <input type="text" id="name" name="name" placeholder="Enter Name" required/>
      <label for="e-mail">E-mail address *</label>
      <input type="email" id="e-mail" name="email" placeholder="Enter Email-Id" required multiple/>
       <label for="phoneNumber">Phone Number</label>
      <input type="number"  name="phoneno"  minlength="10" required placeholder="Enter Phone No." required/>
<!--         <label for="Password">Password</label>-->
<!--    <input type="password" name="pwd" value="<?php echo $autopassword ?>" id = "pswd" placeholder="Enter Password" minlength="8" title="8 characters minimum " required/>-->
<!--<span id = "message" style="color:red"> </span> <br><br>  -->
     <input class="button" type="submit" value="submit" name="submit" >
     <a href="login.php" style="text-align:right;"> login </a>
     </form>

     
</body>

</html>
