<?php
include "conn.php";
error_reporting(E_ERROR | E_PARSE);
session_start();
if($_SESSION['email']){
    header("location: index.php");
  }

if(isset($_POST["submit"])){
    $email = $_POST['email'];
	$password = $_POST['password'];
	$cname=$_POST['client'];
	
    
        $query = "SELECT * FROM login WHERE `email`='$email' and `client_name` = '$cname' ";
        $data=mysqli_query($connectDB,$query) or die("error");
        if(mysqli_num_rows($data)>0){
          while($row=mysqli_fetch_assoc($data)){
              
            if(password_verify($password,$row['password']))
            // if($password==$row['password'])
            {
                header("location: index.php");
                $client=$row['client_name'];
                $_SESSION['email']=$email;
                $_SESSION['client_name']=$client;
            }
            else{
              echo "<span style='color:red;position:absolute;top:296px;left:699px;'>Wrong Password</span>";
            }
        }
    }
}
    

    // if(isset($_SESSION["email"])){
    //     header("location: index.php");
    //   }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <style>
        .main{
            display:flex;
            justify-content:center;
            flex-direction:column;
            align-items:center;
        }
        .form{
            display:flex;
            margin-top:50px;
            justify-content:space-between;
            flex-direction:column;
            align-items:center;
            height:379px;
        }
        input{
            font-size:20px;
            width:400px;
            height:40px;
        }
        .submit{
            font-size: 20px;
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

   *, *:before, *:after {
  box-sizing: border-box;
}
.g-sign-in-button {
  margin: 10px;
  display: inline-block;
  width: 240px;
  height: 50px;
  background-color: #4285f4;
  color: #fff;
  border-radius: 1px;
  box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
  transition: background-color .218s, border-color .218s, box-shadow .218s;
}
.g-sign-in-button:hover {
  cursor: pointer;
  -webkit-box-shadow: 0 0 3px 3px rgba(66,133,244,.3);
  box-shadow: 0 0 3px 3px rgba(66,133,244,.3);
}
.g-sign-in-button:active {
  background-color: #3367D6;
  transition: background-color 0.2s;
}
.g-sign-in-button .content-wrapper {
  height: 100%;
  width: 100%;
  border: 1px solid transparent;
}
.g-sign-in-button img {
    width: 18px;
    height: 18px;
}
.g-sign-in-button .logo-wrapper {
   padding: 15px;
   background:#fff;
   width: 48px;
   height: 100%;
   border-radius: 1px; 
   display: inline-block;
}
.g-sign-in-button .text-container {
    font-family: Roboto,arial,sans-serif;
    font-weight: 500;
    letter-spacing: .21px;
    font-size: 16px;
    line-height: 48px;
    vertical-align: top;
    border: none;
    display: inline-block;
    text-align: center;
    width: 180px;
}
    </style>
    <div class="main">
          <ul class="list-unstyled multi-steps">
    <li class="is-active">Login</li>
    <li>Campaign information</li>
    <li>select template</li>
    <li>Upload assets</li>
    <li>Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
        <h1>Login page</h1>
        <form method="post" class="form" >
            <input type="text" id="client" name="client" placeholder="Enter Client Name">
            <input type="email" id="e-mail" name="email" placeholder="Enter your email">
            
             <input type="password" name="password"  placeholder="Enter your Password" autocomplete="off" readonly 
onfocus="this.removeAttribute('readonly')" required minlength="8" title="8 characters minimum"/>
            <button class="submit" type="submit" name="submit">Submit</button><br>
            <a href="register.php" style="text-align:right;"> Register Now </a>
              <a href="forgot.php" style="text-align:left;"> Forget Password</a>
              
              
              
              
              
  <div class='g-sign-in-button'>
  <div class=content-wrapper>
  <div class='logo-wrapper'>  
    <img src='https://developers.google.com/identity/images/g-logo.png'>
    </div>  
    <span class='text-container'> 
      <span>Sign in with Google</span>
    </span>
  </div>  
</div>

        </form>
    </div>
   
</body>
</html>
