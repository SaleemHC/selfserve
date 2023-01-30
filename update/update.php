<?php
ob_start();
error_reporting(E_ERROR | E_PARSE);
include "../conn.php";
$id=$_GET['id'];
if(isset($_POST['id'])) {
    $id=$_GET['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update</title>
<style>
    
table {
 
  border-collapse: collapse;
  margin-top:20px;
  width: 80%;
  font-size:20px;
  
}

td, th {
  border: 1px solid #dddddd;
  padding: 25px 50px 50px 50px;

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
</head>

<body>
   <ul class="list-unstyled multi-steps">
    <li>Registration form</li>
    <li>Login</li>
    <li>Campaign information</li>
    <li>select template</li>
    <li>Upload assets</li>
    <li class="is-active">Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
    <button onclick="window.location.href = '../';"><b>Home</b></button>
    <button onclick="window.location.href = '../uploadasset/creative.php?id=<?php echo $id ?>';">Go Back</button>
    <h1>Update Animations</h1>
<table>
 <thead>
    
    <th>Previews</th>
    <th>Dimension</th>
    <th>Update Animation</th>
 </thead>
<?php 
$sql1="SELECT * FROM `campaign_info` WHERE id='$id'";
$data1=mysqli_query($connectDB,$sql1);

if(mysqli_num_rows($data1)>0){
    while($row1=mysqli_fetch_assoc($data1)){
        
    $camp = $row1['campaign_name'];
    $client =  $row1['client_name'];   
    $template = $row1['template'];
    $dimension = $row1['dimension']; 
    $abc=explode(",",$dimension);
    
     for($f=0; $f<count($abc); $f++){
      $abc2=explode("x",$abc[$f]);
         $sql2="SELECT * FROM `creativecode` WHERE name='$template' AND campaign='$camp' AND client='$client' AND dimension='$abc[$f]'";
         $data2=mysqli_query($connectDB,$sql2);
         if(mysqli_num_rows($data2)>0){
             while($rowa=mysqli_fetch_assoc($data2)){
                 $id2=$rowa['id'];
                 ?><script> console.log(" <?php echo $rowa['client'] ?>"); console.log(" <?php echo $rowa['filter'] ?>"); </script> <?php 
 ?>     
 <tr>
     <?php if($rowa['finalcode']==""){
     $code=$rowa['content'];
     }else{
      $code=$rowa['finalcode'];} ?>
 <td><div id="main"  style="position:relative;display:flex;flex-wrap:wrap;width:<?php echo $abc2[0] ?>px; height:<?php echo $abc2[1] ?>px"><?php echo $code ?></div></td>
 <td style="text-align:center;"> <?php echo $rowa['dimension']; ?> </td>
 <td style="text-align:center;"><a href="./testanim.php?id=<?php echo $id2 ?>">Update Animation</a></td></tr>
  <?php              
             }
     }
}


}}
 ?>
  <tr>
    
  </tr>


 
</table>
<button type="submit" style="position:absolute;top:150px;right:107px;" name="runs" class="cad" value="runc">
    <a href="https://publisherplex.io/Adtag/previews.php?id=857">Create Ad</a>
</button> 
<button style="position:absolute;top:149px;right:42px;"><a href="../logout.php">Logout</a></button>
 </body>
</html>
