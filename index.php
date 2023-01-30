
<?php 

include "conn.php";
session_start();
if(!$_SESSION['email']){
  header("location: login.php");
}

if(isset($_POST['submit'])){

  
$campaign_name=$_POST['campaign_name'];
$client_name=$_SESSION['client_name'];
$campaign_start=$_POST['campaign_start'];
$campaign_end=$_POST['campaign_end'];
$adtag_type=$_POST['adtag_type'];
$publisher_name=$_POST['publisher_name'];
$campaign_email=$_POST['campaign_email'];

// $check_cam = $campaign_name;
// if(mysqli_num_rows($check_cam) > 0){
//     echo('name Already exists');
// }
$sql_creatcode = "SELECT * FROM `campaign_info` WHERE campaign_name='$campaign_name'";
            $data_creatcode=mysqli_query($connectDB,$sql_creatcode);

if (mysqli_num_rows($data_creatcode) > 0) {
  	 echo "<span style='color:red;font-size:15px;position:absolute;top:208px;left:652px;'>Sorry... Campaign name already taken</span>"; 	
  	}else {
  	      if ((strtotime($campaign_start)) > (strtotime($campaign_end)))
        {
            Echo "<h1 style='color:red;font-size:18px;position:absolute;top:218px;left:700px;'>Please check end date.</h1>";
        }
        else {
          $sql="INSERT INTO `campaign_info`(`campaign_start`,`campaign_end`,`campaign_name`,`adtag_type`,`publisher_name`,`client_name`,`campaign_email`) VALUES ('$campaign_start','$campaign_end','$campaign_name','$adtag_type','$publisher_name','$client_name','$campaign_email')";
          $result=mysqli_query($connectDB,$sql);
          $sql17 = "SELECT MAX(id) as max_id FROM `campaign_info`";  
          $result17=mysqli_query($connectDB,$sql17);
          $row = $result17->fetch_assoc();
          $idd=$row['max_id'];
          header("location:./template/index.php?id=$idd");
        }
          	}



} 
  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  <!--<link rel="stylesheet" href="style.css">-->
    <style>
        .dropdown-menu{ max-height:250px; overflow:auto;margin-bottom:30px; }
        form{
            margin-left:50px;
        }
        
        .heading{
          text-align:center;
          margin-bottom:30px;
        }

        label{
  padding:20px;
        }

        .container{
          text-align:left;
          width:460px;
        }
        
        #cemail{
          margin-left:110px;
        }
        
        .img {
        height: 15px;
        width: 15px;
        /* padding: 0px 10px 0px 10px; */
        margin: 4px 5px 5px 5px;
        cursor: pointer;
        vertical-align: middle;
    }
    
    .btn-danger{
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
    position: absolute;
    top:10px;
    left:93%;
    text-align: center;
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
  <title>Campaign Info</title>
</head>
<body>
    <div class="main">
   <ul class="list-unstyled multi-steps">
    <li>Login</li>
    <li class="is-active">Campaign information</li>
    <li>select template</li>
    <li>Upload assets</li>
    <li>Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
    <h1 class="heading">Campaign Information</h1>

    <form action="" method="post">
      <div class="container">
        <label for="campaign_name">Enter Campaign name: </label> <input id="input1" name="campaign_name" placeholder="enter movie/show name" type="text" required onkeyup="specialcharecter();"><span><img src="https://publisherplex.io/selfserve/info.png" class="img" title="Enter only movie or show title Ex: KGF, Mirzapur"/></span><br><br>
        <label for="campaign_start">Enter Campaign start date: </label> <input name="campaign_start" type="datetime-local"><br><br>
        <label for="campaign_end">Enter Campaign end date: </label> <input name="campaign_end" type="datetime-local"><br><br>
        <label for="adtag_type" required>Choose adtag type: </label>
        <select id="adtag_type" name="adtag_type">
    <option value="dcm">DCM</option>
    <option value="dv360">DV360</option>
    <option value="dv360/dbmc">DV360/Dbmc</option>
    <option value="dfp">DFP</option>
    <option value="criteo">CRITEO</option>
    <option value="sports">Sports</option>
  </select>
        <br><br>
        <label for="publisher_name">Enter publisher name: </label> <input id="input2" onkeyup="specialcharecter();" name="publisher_name" placeholder="enter publisher name" type="text"><br><br>
        <label for="campaign_email">Enter Email (comma separated) Working on campaign: </label> <input id="cemail" type="email" name="campaign_email" placeholder="enter email-id" required multiple><br><br>
<div style="text-align:center;">
<button class="btn btn-success" type="submit" name="submit">Submit</button>
</div>
</div> 
    </form>
    <button class="btn btn-danger"><a href="logout.php" style="color:white;text-decoration:none">logout</a></button>
    </div>
    <script>
let $select = $('#templates_drop').multiselect({
  enableFiltering: true,
  includeFilterClearBtn: true,
  enableCaseInsensitiveFiltering: true
  
});

function specialcharecter() {
        var iChars = "!`@#$%^&*()+=-[]\\';,./{}|\":<>?~_";

        var data = document.getElementById("input1").value;
        var data2 = document.getElementById("input2").value;

        for (var i = 0; i < data.length; i++) {
          if (iChars.indexOf(data.charAt(i)) != -1) {
            alert("Your string has special characters.These are not allowed.");

            document.getElementById("input1").value = "";

            return false;
          }
        }
        for (var i = 0; i < data2.length; i++) {
          if (iChars.indexOf(data2.charAt(i)) != -1) {
            alert("Your string has special characters.These are not allowed.");

            document.getElementById("input2").value = "";

            return false;
          }
        }
      }
    </script>
</body>
</html>