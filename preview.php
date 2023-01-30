<?php
ob_start();
include "conn.php";
error_reporting(E_ERROR | E_PARSE);
$id = $_GET['id'];
if (isset($_POST['id'])) {
  $id = $_GET['id'];

}
$mailId = "prathamesh.bhagwat@hockeycurve.com"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Previews</title>
  <style>
     .container {
      margin-left: 100px;
    }
 .popup{height:200px;width:300px;position:fixed;top:45%;left: 42%;color:black;font-weight:bold;border: 3px solid black;background: #b9ebff;text-align:center;justify-content: center;}
 .popup2{height:200px;width:300px;position:fixed;top:45%;left: 42%;border: 3px solid black;z-index: 10;background:#b9ebff;text-align: center;justify-content: center;}
 .btn1{position:absolute;top:68%;left: 10%;background-color:green;color:white;width:110px;height:33px}
 .btn2{position:absolute;top:68%;background-color:red;color:white;width:110px;height:33px}
 .btn3{position:absolute;top:50%;left:26%;background-color:green;color:white;width:140px;height:33px}
 .box1{position:absolute;top:75px;left:115px;border:2px solid grey;width:1447px;height:40px;display:flex;align-items:center;}
  </style>
</head>

<body>
  <form method="POST">
    <div>
      <?php
      $sql = "SELECT * FROM `adtagdata` WHERE id=$id LIMIT 1";
      $result = mysqli_query($connectDB, $sql);
      $row = mysqli_fetch_assoc($result);
      ?>
      <h2 style="text-align:center"><?php echo $row['campaign_name'] ?></h2>
      <div class="box1">
      <div style="position: absolute;top: 7px;left: 419px;font-size: 17px;font-weight: bold;">This icon indicates "click test is done"</div> 
      <div style="position:absolute;top:7px;left:812px;font-size: 17px;font-weight: bold;">This icon indicates "click test is pending"</div> 
      <img id="green" style="position: absolute;top: 2px;left:377px;width: 30px;height: 30px;" src="./tick.webp">
      <img id="red" style="position:absolute;top:2px;left:773px;width:30px;height:30px" src="./cross.png">
       <img id="icon" style="    position: absolute;top: 4px;right: 6px;width: 26px;height: 27px;" src="./icon.png">
      </div>
      
      <br><br>
       <button id="btn" style = "position: absolute;top: 30px;left: 115px;">Back</button> 
       <button name="retest" style = "position: absolute;top: 30px;right: 235px;" >Retest</button> 
    </div>
    <br>
    <div class="container">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Dimension</th>
            <th>Previews</th>
            <th style="visibility: hidden;">Check</th>
            <th>Test Mark</th>
            <th>Click Trackers</th>
            <th>Impression Trackers</th>
            <th>Update Trackers</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $dims = $row['dims'];

          $str_arr = explode(",", $dims);
          $i = 0;
          while ($i < count($str_arr)) {
            $wh_dim = explode("x", $str_arr[$i]) ?>
            <tr>
              <td><?php echo $str_arr[$i] ?></td>
              <td id='<?php echo $i ?>'>
                <?php
                if ($row["fcat_n"] == "") { ?>
                  <?php if ($row["geo"] == "") {
                    if ($row["adtag_type"] == "DCM") {
                  ?> <div class='hockeycurve-v1'>
                        <div style="width:<?php echo $wh_dim[0] ?>px;height:<?php echo $wh_dim[1] ?>px;z-index:5;">
                          <iframe id='main-ad-tag<?php echo $i ?>' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                        </div>


                        <script type='text/javascript'>
                          var params = {
                            'client': '<?php echo $row['client'] ?>',
                            'fcat': '<?php echo $row['fcat'] ?>',
                            'ct0': '%c_esc',
                            'lp0': '%u',
                            'cb': '%n',
                            'dbmc': '<?php echo $row['fcat'] ?>'
                          }
                          var cs = '';
                          for (var p in params) {
                            cs += '&' + encodeURIComponent(p) + '=' + encodeURIComponent(params[p]);
                          }
                          var final_src = 'https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&partner=dcm&optout=false' + cs
                          document.getElementById('main-ad-tag<?php echo $i ?>').src = final_src
                        </script><br>
                      </div>
                    <?php } else if ($row["adtag_type"] == "Dv360") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "Dv360Dbmc") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=<?php echo $row['fcat'] ?> frameborder=' 0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "DFP") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=' ${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "CRITEO") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=' ${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''></iframe>
                    <?php } else if ($row["adtag_type"] == "Sports") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER} frameborder=' 0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php }
                  } else if ($row["geo"] == "true") {
                    if ($row["adtag_type"] == "DCM") { ?>
                      <div class='hockeycurve-v1'>
                        <iframe id='main-ad-tag<?php echo $i ?>' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                        <script type='text/javascript'>
                          var params = {
                            'client': '<?php echo $row['client'] ?>',
                            'fcat': '<?php echo $row['fcat'] ?>',
                            'geo': 'true',
                            'ct0': '%c_esc',
                            'lp0': '%u',
                            'cb': '%n',
                            'dbmc': '<?php echo $row['fcat'] ?>'
                          }
                          var cs = '';
                          for (var p in params) {
                            cs += '&' + encodeURIComponent(p) + '=' + encodeURIComponent(params[p]);
                          }
                          var final_src = 'https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&partner=dcm&optout=false' + cs
                          document.getElementById('main-ad-tag<?php echo $i ?>').src = final_src
                        </script>
                      </div>
                    <?php } else if ($row["adtag_type"] == "Dv360") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "Dv360Dbmc") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=<?php echo $row['fcat'] ?>' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "DFP") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=true&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=' ${CAMPAIGN_ID}'' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "CRITEO") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=true&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=' ${CAMPAIGN_ID}'' frameborder='0' scrolling='no' width='Jpeg' height=''></iframe>
                    <?php } else if ($row["adtag_type"] == "Sports") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php }
                  } else if ($row["geo"] == "bcamp") {
                    if ($row["adtag_type"] == "DCM") {
                    ?><div class='hockeycurve-v1'>
                        <iframe id='main-ad-tag<?php echo $i ?>' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                        <script type='text/javascript'>
                          var params = {
                            'client': '<?php echo $row['client'] ?>',
                            'fcat': '<?php echo $row['fcat'] ?>',
                            'geo': 'bcamp',
                            'ct0': '%c_esc',
                            'lp0': '%u',
                            'cb': '%n',
                            'dbmc': '<?php echo $row['fcat'] ?>'
                          }
                          var cs = '';
                          for (var p in params) {
                            cs += '&' + encodeURIComponent(p) + '=' + encodeURIComponent(params[p]);
                          }
                          var final_src = 'https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&partner=dcm&optout=false' + cs
                          document.getElementById('main-ad-tag<?php echo $i ?>').src = final_src
                        </script>
                      </div>
                    <?php } else if ($row["adtag_type"] == "Dv360") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "Dv360Dbmc") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=<?php echo $row['fcat'] ?>' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "DFP") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "CRITEO") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''></iframe>
                    <?php } else if ($row["adtag_type"] == "Sports") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&fcat=<?php echo $row['fcat'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                  <?php }
                  }
                } else if ($row["fcat_n"] == "fcat_nan") { ?>
                  <?php if ($row["geo"] == "") {
                    if ($row["adtag_type"] == "Dv360") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "DFP") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "CRITEO") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client'] ?>&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''></iframe>
                    <?php } else if ($row["adtag_type"] == "Sports") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php }
                  } else if ($row["geo"] == "true") {
                    if ($row["adtag_type"] == "Dv360") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "DFP") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&geo=true&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "CRITEO") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client'] ?>&geo=true&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''></iframe>
                    <?php } else if ($row["adtag_type"] == "Sports") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php }
                  } else if ($row["geo"] == "bcamp") {
                    if ($row["adtag_type"] == "Dv360") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "DFP") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } else if ($row["adtag_type"] == "CRITEO") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''></iframe>
                    <?php } else if ($row["adtag_type"] == "Sports") { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client'] ?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                <?php }
                  }
                }
                ?>
              </td>
  </form>
  <td><button id='tag<?php echo $i ?>' name='ctest<?php echo $i ?>' style="visibility: hidden;">Check</button></td>
  <td><?php $clk = $row['click_test'];

            $clk2 = explode(",", $clk);
            $cclk = count($clk2);
            $sclk = array_sum($clk2);

            if ($clk2[$i] == 0) {
      ?><img height="30px" width="30px" src="./cross.png" alt=""> <?php
                                                                } else {
                                                                  ?><img height="30px" width="30px" src="./tick.webp" alt=""> <?php
                                                                                                                            }


                                                                                                                              ?></td>
  <td>NA</td>
  <td>NA</td>
  <td><button>Update Tracker</button></td>
  </tr><?php
            $i++;
          }
        ?>
</tbody>
</table>


<?php
for ($p = 0; $p < count($str_arr); $p++) {

  if (isset($_POST['ctest' . $p])) {
    $clk2[$p] = 1;
    $clk3 = implode(",", $clk2);
    $updateQuery2 = "UPDATE adtagdata SET click_test = '$clk3'  where id = $id";
    $executeQuery = mysqli_query($connectDB, $updateQuery2);
    header("location:preview.php?id=" . $id);

    ob_end_flush();
  };
};

?>
<?php
if ($cclk == $sclk) {
 ?><div class="popup" style="">
<h3>Are You Satisfied With Your Landing Page?</h3>
<button name="yes" class="btn1">Yes</button><button name="no" class="btn2">No</button>
 </div><?php
 if(isset($_POST['yes'])){
  ?> <div class="popup2" style="">
  <h3 Style="font-size:30px;">congratulation</h3>
  <h6 Style="font-size:20px;">Your Creative Is Ready</h6>
  <button name = 'adtagbtn' class="btn3">View Adtag Page</button> 
  <h6 Style="font-size: 15px;top: 25%;position: relative;">Your Creative Will be Sent to :-</h6>
  <h6 Style="font-size: 15px;top: 25%;position: relative;"><?php echo ($mailId)?></h6>
   </div><?php
 } 
 elseif(isset($_POST['no'])){
  for ($p=0;$p<count($str_arr);$p++){
    $clk2[$p] = 0;
  };
$clk3 = implode(",", $clk2);
  $updateQuery2 = "UPDATE adtagdata SET click_test = '$clk3'  where id = $id";
  $executeQuery = mysqli_query($connectDB, $updateQuery2);
  header("location:preview.php?id=" . $id);

  ob_end_flush();
 };
 
}
?>
</div>

<?php

if (isset($_POST['adtagbtn'])) {

  header("location:adtags.php?id=" . $id);

  // $to = "$_SESSION['email']";
  
    $to = "dinesh@hockeycurve.com ";
    $message = "Hello Team, <br> \r\n\r\n";

    $message .="PFB adtags and previews for " .  $row['campaign_name'] . "<br><br> \r\n\r\n";
    
    $message .="Adtag - https://publisherplex.io/Adtag/adtags.php?id=".$row['id']."<br><br> \r\n\r\n";
    
    $message .="Preview - https://publisherplex.io/Adtag/previews.php?id=".$row['id']."<br><br> \r\n\r\n".
    
    " <b>Requesting you to please ignore the above mail </b><br><br> \r\n\r\n".
    // "Link for tool- https://publisherplex.io/Adtag/index.php<br><br>\r\n\r\n";
    
    $message .="Thanks and Regards  <br>\r\n";
    $message .="Development Team";
     $subject ="Preview - " . $row['campaign_name'];
    $header = "From:shivam.singh@hockeycurve.com  \r\n";
    $header.= 'Cc:prathamesh.bhagwat@hockeycurve.com'."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail ($to,$subject,$message,$header);
    
    
    $to1 = "dinesh@hockeycurve.com";
    $message1 = "Hello Team, <br> \r\n\r\n";

    $message1 .="PFB adtags and previews for " .  $row['campaign_name'] . "<br><br> \r\n\r\n";
    
    $message1 .="Adtag - https://publisherplex.io/Adtag/adtags.php?id=".$row['id']."<br><br> \r\n\r\n";
    
    $message1 .="Preview - https://publisherplex.io/Adtag/previews.php?id=".$row['id']."<br><br> \r\n\r\n".
    
    " <b>Requesting you to please ignore the above mail </b><br><br> \r\n\r\n".
    // "Link for tool- https://publisherplex.io/Adtag/index.php<br><br>\r\n\r\n";
    
    $message1 .="Thanks and Regards  <br>\r\n";
    $message1 .="Development Team";
     $subject1 ="Preview -" . $row['campaign_name'];
    $header1 = "From:pooja@hockeycurve.com \r\n";
    // $header.= 'Cc:prathamesh.bhagwat@hockeycurve.com'."\r\n";
    $header1 .= "MIME-Version: 1.0\r\n";
    $header1 .= "Content-type: text/html\r\n";
    $retval1 = mail ($to1,$subject1,$message1,$header1);
                  
  
}

if(isset($_POST['retest'])){
  for ($p=0;$p<count($str_arr);$p++){
    $clk2[$p] = 0;
  };
$clk3 = implode(",", $clk2);
  $updateQuery2 = "UPDATE adtagdata SET click_test = '$clk3'  where id = $id";
  $executeQuery = mysqli_query($connectDB, $updateQuery2);
  header("location:preview.php?id=" . $id);

  ob_end_flush();
 };
?>

 <script>
  var lstr = <?php echo count($str_arr) ?>;
  focus();
  const listener = addEventListener('blur', function() {
    iframe = document.activeElement.id;
    var click = iframe.split("-");
    if (document.activeElement.id === iframe) {
        setTimeout(function clk() {
         document.getElementById(click[2]).click();
         console.log(click[2]);
          }, 200);

    }
    removeEventListener('blur', listener);
  });
</script> -->

</body>

</html>