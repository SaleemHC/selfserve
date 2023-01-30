<?php

include "../conn.php";

session_start();
$_SESSION['client_name'];
if(!$_SESSION['email']){
  header("location: ../login.php");
}
$id=$_GET['id'];
if(isset($_POST['id'])) {
    $id=$_GET['id'];
}

$autofcats = "";
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $charCount = strlen($characters);
  for($i=0;$i<6;$i++){
    $autofcats.= substr($characters,rand(0,$charCount),1);
  }


if(isset($_POST['submit'])){

  $countryarr=$_POST["dim"];
        $newvalues=  implode(",", $countryarr);
        $template=$_POST['temp'];
        
    $sql="UPDATE `campaign_info` SET `dimension`='$newvalues',`template`='$template' WHERE id=$id";
    $result=mysqli_query($connectDB,$sql);

$_SESSION['fcat'] = $autofcats;
$_SESSION['dim_cnt'] = 0;
  $_SESSION['ast_val'] = 0;
  header("location: ../uploadasset/creative.php?id=$id");
 
    
  } 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <script type="text/javascript" src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <title>Template page</title>
  <style>
/*table,td,th{*/
/*            border: 1px solid #000;*/
/*        }*/
        
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
    <li>Login</li>
    <li>Campaign information</li>
    <li class="is-active">select template</li>
    <li>Upload assets</li>
    <li>Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
<a href="../logout.php" class="btn btn-danger" style="position:absolute;top:5px;right:5px">Logout</a>

<div style="margin:40px">Select Template : <select id="template-box">
                             <option value="">Select Template</option>
                            </select></div>
          

      
      <table id="main" style="margin:40px" >
    <tr>
      <td id="table-data">
          <span style="font-size:20px;font-weight:bold">Some Demo ads</span>
          <table>
              <tr>
                  <td style="padding:20px;text-align:center">
                      <div class="click" id="search" style="position:absolute;width:300px;height:250px;z-index:20;"></div>
                      <iframe style="scale:0.7" src='https://ad.hockeycurve.com/ad.php?zoneid=300x250&client=plumsearch&fcat=pldc4js&optout=false' frameborder='0' scrolling='no' width='300' height='250'></iframe>
                      
                  </td>
                  <td style="padding:20px;text-align:center">
                      <div class="click" id="richmedia" style="position:absolute;width:300px;height:250px;z-index:20;"></div>
                      <iframe style="scale:0.7" src='https://ad.hockeycurve.com/ad.php?zoneid=300x250&client=aprimeauto&fcat=aajsma&optout=false' frameborder='0' scrolling='no' width='300' height='250'></iframe>
                      
                  </td>
                  <td style="padding:20px;text-align:center">
                      <div class="click" id="static" style="position:absolute;width:300px;height:250px;z-index:20;"></div>
                      <iframe style="scale:0.7" src='https://ad.hockeycurve.com/ad.php?zoneid=300x250&client=mpl1auto&fcat=mplstpv&optout=false' frameborder='0' scrolling='no' width='300' height='250'></iframe>
                      
                  </td>
              </tr>
              <tr>
                  <td style="text-align:center">
                      Search
                  </td>
                  
                  <td style="text-align:center">
                      Rich Media
                  </td>
                  <td style="text-align:center">
                      Static Ad (Only 1 image used)
                  </td>
              </tr>
          </table>
      </td>
    </tr>
  </table>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  


<script type="text/javascript">

// function updateDiv()
// { 
//     $( "#table-data" ).load(window.location.href + " #table-data" );
// }

    function clickchange(){
        localStorage.clear();
    }

  $(document).ready(function(){
      
    $.ajax({
      url : "load-templates.php",
      type : "POST",
      dataType : "JSON",
      success : function(data){
        $.each(data, function(key, value){
          $("#template-box").append("<option  value='" + value.template_name + "'>" + value.template_name + "</option>");
        });
      }
    });

    // Load Table Data
    
      $(".click").click(function(e){
      var value=e.target.id;
        document.querySelector('option[value='+value+']').selected = true
        var template=$("#template-box").val()
        $.ajax({
          url : "load-table.php",
          type : "POST",
          data : { template : template },
          success : function(data){

            $("#table-data").html(data);
          }
        });
      
      })
    $("#template-box").change(function(){
      var template = $(this).val();

      if(template == ""){
        $("#table-data").html("");
      }else{
        $.ajax({
          url : "load-table.php",
          type : "POST",
          data : { template : template },
          success : function(data){

            $("#table-data").html(data);
          }
        });
      }
    })
  });
</script>
</body>

</html>
