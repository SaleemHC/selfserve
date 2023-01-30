<?php
include "conn.php";
$autopassword="";
  $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $charCount = strlen($characters);
  for($i=0;$i<8;$i++){
    $autopassword.= substr($characters,rand(0,$charCount-1),1);
  }
//   $sqlpassword = "SELECT DISTINCT password FROM login";
//   $resultpassword = mysqli_query($conn,$sqlpassword);
//   while($row = mysqli_fetch_array($resultpassword))
//         {
//           if($row['password'] === $autopassword){
//               echo "password is their" ;
//               header("Refresh:0");//refresh
//             }}
  
if(isset($_POST['submit'])){
$cname=$_POST['uname'];
$email=$_POST['email'];
$up=$_POST['onep'];

 $password=password_hash($autopassword, PASSWORD_DEFAULT);
 if($up=="self"){
    $sql= "UPDATE `login` SET `password`='$password' WHERE client_name='$cname' AND email='$email'"; 
    // echo $sql;
      $result=mysqli_query($connectDB, $sql);
    //   echo "$autopassword";
    //   echo "success";
    $check="SELECT * FROM `login` WHERE client_name='$cname' AND email='$email'"; 
 }
  elseif($up=="one"){
         $sql= "UPDATE `login` SET `password`='$password' WHERE client_name='$cname'";  
      $result=mysqli_query($connectDB, $sql);
          $check="SELECT * FROM `login` WHERE client_name='$cname'"; 

  }
  else{
      echo "Please check the client name";
  }
  
      $resultmail=mysqli_query($connectDB, $check);
    while($row=mysqli_fetch_assoc($resultmail)){
        // echo $row['password'];
        $emailall.=$row['email'].",";
        
        
    }
    
    
     $to = $emailall . ", sapna.g@hockeycurve.com";

    $message = "Hello " .$cname . ", <br> \r\n\r\n";

     $message .= "Your Mail ID-  " . $email . " <br><br>  \r\n\r\n";
    $message .= "Your Password Is-  " . $autopassword . " <br> \r\n\r\n";
     $message .="Thanks & Regards <br>";
 
    $message .="HockeyCurve ";

     $subject ="Registration of Client";
    $header = "From:sapna.g@hockeycurve.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
                 $header .= "Content-type: text/html\r\n";
                     $retval = mail ($to,$subject,$message,$header);
                    //  echo $header;
    
}  






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot_password</title>
    <style>
        .form-container {
            display:flex;
                    justify-content:center;
                    flex-direction:column;
                    align-items:center;
                    height:398px;
                     /*border:1px solid black; */
                   
                }
              .abc {
text-transform: uppercase;
}

#e-mail {
/* background: white; */
font-size: 14px;
display: block;
padding: 10px 30px 10px 5px;
margin: 5px 0 20px;
border: 2px solid black;
border-radius:5px;
/* border-bottom: 2px solid grey; */
font-size:16px;
          width:250px;
          height:15px;
}
#uname {
/* background: white; */
font-size: 14px;
display: block;
padding: 10px 30px 10px 5px;
margin: 5px 0 20px;
border: 2px solid black;
border-radius:5px;
/* border-bottom: 2px solid grey; */
font-size:16px;
          width:250px;
          height:15px;
}

.button {
    background: #66cc99;
    border: 0;
    padding: 10px 15px;
    /* transform: translate(-50%, 0); */
    color: white;
    text-transform: uppercase;
    text-align: center;
    font-size: 13px;
    height: 40px;
    width: 113px;
    border-radius: 5px;
}

  .radioo{
      font-size:20px;
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
    <ul class="list-unstyled multi-steps">
    <li>Registration form</li>
    <li class="is-active">forgot password</li>
   <li>Login</li>
    <li>Campaign information</li>
    <li>select template</li>
    <li>Upload assets</li>
    <li>Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
    <div class="form-container">
            <form name="forgot_password" method="post">
        <label class="abc" for="uname">Client Name</label>
        <input type="text" id="uname" name="uname" placeholder="Enter your Client- Name" required/><br>
        
        <label class="abc" for="e-mail">E-mail Address *</label>
        <input type="email" id="e-mail" name="email" placeholder="Enter Email-Id"  required multiple/>
     <p class="abc">Please select </p>
     <input type="radio" id="yself" name="onep" value="self" required>
     <label class="radioo" for="self">Yourself</label><br>
     <input type="radio" id="eone" name="onep" value="one" >
     <label class="radioo" for="one">Everyone</label><br><br><br>
     <input class="button" type="submit" value="submit" name="submit" >
      </form>
      <a href="login.php" style="text-align:right;font-size:20px"> login </a>
    </div>

      
</body>
</html>