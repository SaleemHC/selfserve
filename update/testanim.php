<?php
ob_start();
session_start();
include "../conn.php";
error_reporting(E_ERROR | E_PARSE);
$id=$_GET['id'];
    if(isset($_POST['id'])) {
        $id=$_GET['id'];
    }
    
    
    
    $sqlar="SELECT * FROM `creativecode` WHERE id='$id'";
         $dataar=mysqli_query($connectDB,$sqlar);
         if(mysqli_num_rows($dataar)>0){
                        while($rowar=mysqli_fetch_assoc($dataar)){
                            $assetsar=$rowar['asset_used'];
                            $animation21=$rowar['animation'];
                            $sassetar=explode(",",$assetsar);
                            for ($a=0;$a<count($sassetar);$a++){
                                
                                
                                
                                $pavan =$sassetar[$a]."-animation";
                                $adithi=$sassetar[$a]."-durn";
                                $jasmeet=$sassetar[$a]."-delay";
                                $saleem=$sassetar[$a]."-repeatd";
                                $sapna=$sassetar[$a]."-repeat";
                                $opacity = $sassetar[$a]."-opc";
                                
                                $idd=$sassetar[$a];
                                $erepeat=$_POST[$sapna];
                                $durn=$_POST[$adithi];
                                $edelay=$_POST[$jasmeet];
                                $erdelay=$_POST[$saleem];
                                $opc = $_POST[$opacity];
                                
                                $arr=array($idd,$erepeat,$durn,$edelay,$erdelay,$opc);
                                $arr2=array("idd","erepeat","durn","edelay","erdelay","opc");
                                
                                $animation .= str_replace($arr2,$arr,$_POST[$pavan]);
if(isset($_POST['preview'])){
   
                                
                                if($rowar['animation']==""){
                                    $sqlms="UPDATE `creativecode` SET `animation`='$animation' WHERE id='$id'";
         $datams=mysqli_query($connectDB,$sqlms);
                                }
                                else{
                                    $sqlms="UPDATE `creativecode` SET `test_anim`='$animation' WHERE id='$id'";
         $datams=mysqli_query($connectDB,$sqlms);
                                }
                             
                            }
                                

if(isset($_POST['cancel'])){
                               $sqlms2="UPDATE `creativecode` SET `test_anim`='$animation21' WHERE id='$id'";
         $datams2=mysqli_query($connectDB,$sqlms2);
            
}

                            }}
                            if(isset($_POST['save'])){
                                    
                                    $ani='<script>'.$animation.'</script>';
                                    $final=$rowar['content'].$ani;
                                    $sqlms3="UPDATE `creativecode` SET `finalcode`='$final' WHERE id='$id'";
         $datams3=mysqli_query($connectDB,$sqlms3);
                               $sqlms2="UPDATE `creativecode` SET `test_anim`='$animation' WHERE id='$id'";
         $datams2=mysqli_query($connectDB,$sqlms2);
                                    $sqlms1="UPDATE `creativecode` SET `animation`='$animation' WHERE id='$id'";
         $datams1=mysqli_query($connectDB,$sqlms1);
         Echo "<span style='color:green;font-size:25px;'>Animation updated successfully</span>";
                         
                         
}
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
 /* *{margin: 0;padding: 0;box-sizing: border-box;} */
    li {
        font-size: 18px;
    }

    .img {
        height: 15px;
        width: 15px;
        /* padding: 0px 10px 0px 10px; */
        margin: 4px 5px 5px 5px;
        cursor: pointer;
        vertical-align: middle;
    }
    .container-fluid{
        margin-bottom: 50px;
    }
    /* .table1 thead tr td:nth-child(8){
        display: none;
        border: 0px !important;
    }
    .trc td:nth-child(8){
        display: none;
    } */
    
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
.table1 td a{
    text-decoration: none;
    cursor: pointer;
    color: black;
}
</style>
<body>
    <?php
     $sql1="SELECT * FROM `creativecode` WHERE id='$id'";
         $data1=mysqli_query($connectDB,$sql1);
         $row1=mysqli_fetch_assoc($data1);
         $campaign_n=$row1['campaign'];
     $sql2="SELECT * FROM `campaign_info` WHERE campaign_name='$campaign_n'";
         $data2=mysqli_query($connectDB,$sql2);
         $row2=mysqli_fetch_assoc($data2);
         $id2=$row2['id'];
    ?>
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
    <button onclick="window.location.href = './update.php?id=<?php echo $id2 ?>';">Go Back</button>
    <form method='POST'><table class='table1' id='table1'>
    <thead>
    <tr>
        <td>Assets</td>
        <td>Select Animation <a href=https://docs.google.com/document/d/1GsykYm6opeKyAMagWFa0rnQ2QK3d5CzhYLWGUB9Zr8o/edit;" target="_blank">&#9432;</a></td>
        <td>Opacity <a href=https://docs.google.com/document/d/1GsykYm6opeKyAMagWFa0rnQ2QK3d5CzhYLWGUB9Zr8o/edit;" target="_blank">&#9432;</a></td>
        <td class='dn'>Duration <a href=https://docs.google.com/document/d/1GsykYm6opeKyAMagWFa0rnQ2QK3d5CzhYLWGUB9Zr8o/edit;" target="_blank">&#9432;</a></td>
        <td class='dy'>Delay <a href=https://docs.google.com/document/d/1GsykYm6opeKyAMagWFa0rnQ2QK3d5CzhYLWGUB9Zr8o/edit;" target="_blank">&#9432;</a></td>
        <td class='ry'>Repeat Delay <a href=https://docs.google.com/document/d/1GsykYm6opeKyAMagWFa0rnQ2QK3d5CzhYLWGUB9Zr8o/edit;" target="_blank">&#9432;</a></td>
        <td class='ar'>Animation Repeat Count <a href=https://docs.google.com/document/d/1GsykYm6opeKyAMagWFa0rnQ2QK3d5CzhYLWGUB9Zr8o/edit;" target="_blank">&#9432;</a></td>
    </tr></thead><tbody>
    <?php
        $sql="SELECT * FROM `creativecode` WHERE id='$id'";
         $data=mysqli_query($connectDB,$sql);
         if(mysqli_num_rows($data)>0){
                        while($row=mysqli_fetch_assoc($data)){
                            $assets=$row['asset_used'];
                            $sasset=explode(",",$assets);
                            for ($i=0;$i<count($sasset);$i++){
                              ?> <tr> <td><?php echo $sasset[$i]; ?></td>  <td>
                                  <select id="<?php echo $sasset[$i]; ?>-animation" name="<?php echo $sasset[$i]; ?>-animation">
                                <?php  $sql2="SELECT * FROM `anim_repo`";
         $data2=mysqli_query($connectDB,$sql2);
         if(mysqli_num_rows($data2)>0){
                        while($row2=mysqli_fetch_assoc($data2)){
                            ?> <option value='<?php echo $row2["anim"] ?>'><?php echo $row2['name'] ?></option> <?php
                        }}
                                  ?>
                                  </select></td>
        <td><input id="<?php echo $sasset[$i]; ?>opc" type='text' name="<?php echo $sasset[$i]; ?>-opc" value='0' pattern='[0-1]' placeholder='Opacity' class='ropc'></td>
        <td><input id="<?php echo $sasset[$i]; ?>durn" name="<?php echo $sasset[$i]; ?>-durn" type='text' value='1'  placeholder='Duration' class='rdurn'></td>
        <td><input id="<?php echo $sasset[$i]; ?>delay" name="<?php echo $sasset[$i]; ?>-delay" type='text' value='1' placeholder='Delay' class='rdelay'></td>
        <td><input id="<?php echo $sasset[$i]; ?>repeatd" name="<?php echo $sasset[$i]; ?>-repeatd" type='text' value='1' placeholder='repeat delay' class='rclass'></td>
        <td><input id="<?php echo $sasset[$i]; ?>repeat" name="<?php echo $sasset[$i]; ?>-repeat" type='number' value='1' placeholder='No.of repeats' class='rnumber'></td></tr> 
        <?php
                            }}}?>
    
   </tbody>
    </table><br>
<button name='preview' id='preview1'    style='border:1px solid black;font-size:15px;cursor:pointer;'>Preview</button>
<button name='save' id='save1' style='border:1px solid black;font-size:15px;cursor:pointer;margin:0 10px;'>Save</button>
<span id="text1" style="display:none"></span>
<button name='cancel' id='cancel1'  style='border:1px solid black;font-size:15px;cursor:pointer;'>Cancel</button> 
<span style="display:block" class='txt_val' id='showvalue'></span>
</form>
<div style="position:relative;margin-top:30px;">
    <?php
$sqljs="SELECT * FROM `creativecode` WHERE id='$id'";
         $datajs=mysqli_query($connectDB,$sqljs);
while($rowjs=mysqli_fetch_assoc($datajs)){
    
    
    $anim="<script>".$rowjs['test_anim']."</script>";
    $total=$rowjs['content'].$anim;
    
    // echo $rowjs['animation'];
    // echo $rowjs['test_anim'];
    $ram= $rowjs['test_anim'];
    $ram_anim = $rowjs['animation'];
$assetnum = explode('function', $ram);
    for ($sal = 1; $sal < count($assetnum); $sal++) {

        $thodo = explode('_', $assetnum[$sal]);
        $assetpv = explode(' ', $thodo[0]);
        $thodojyada = explode('()', $thodo[1]);
        // echo $thodojyada[0];
        

        $peev = explode('repeat:', $assetnum[$sal]);
        $pv = explode(',', $peev[1]);

        $peev2 = explode('repeatDelay:', $assetnum[$sal]);
        $pv2 = explode(',', $peev2[1]);


        $peev3 = explode('opacity:', $assetnum[$sal]);
        $pv3 = explode(',', $peev3[1]);


        $peev4 = explode('  ', $assetnum[$sal]);
        $pv4 = explode('/', $peev4[1]);
        

        $peev5 = explode('delay:', $assetnum[$sal]);
        $pv5 = explode('}', $peev5[1]);
        
         $rp4 = $pv4[0];
         $rp5 = $pv5[0];
         $rp2 = $pv2[0];
        $rp = $pv[0];
        $rp3 = $pv3[0];
       
       ?> <script> 
       var smn = document.querySelector("tbody").children;
            // console.log(smn);
             
            var alltd = smn[<?php echo ($sal - 1) ?>].querySelectorAll("td");

            for (let in2 = 0; in2 < alltd.length; in2++) {
                if (in2 == 1) {
                    alltd[in2].querySelectorAll("option").forEach((el) => {
                        if (el.innerText.toString() == "<?php echo $thodojyada[0]; ?>") {
                            el.setAttribute('selected', 'true');
                            // console.log(el.innerText)
                        }
                    })
                }
                if (in2 == 2) {
                    var intd = alltd[in2].querySelector("input").value = "<?php echo $rp3; ?>";

                }
                if (in2 == 3) {
                    var intd = alltd[in2].querySelector("input").value = "<?php echo $rp4; ?>";
                }
                if (in2 == 4) {
                    var intd = alltd[in2].querySelector("input").value = "<?php echo $rp5; ?>";
                }
                if (in2 == 5) {
                    var intd = alltd[in2].querySelector("input").value = "<?php echo $rp2; ?>";
                }
                if (in2 == 6) {
                    var intd = alltd[in2].querySelector("input").value = "<?php echo $rp; ?>";
                }
                // if (in2 == 7) {
                //     var intd = alltd[in2].querySelector("input").value = all;
                // }
                var dration = <?php echo $rp4; ?>;
                var dly = <?php echo $rp5; ?>;
                var rdly = <?php echo $rp2; ?>;
                var rpt = <?php echo $rp; ?>;
                var all = dly + dration + (dration * rpt) + (rdly * rpt);
                

            }  
            
            jQuery(function($) {
                
                $('#<?php echo $assetpv[1] ?>durn').keyup(function() {
                    var <?php echo $assetpv[1] ?>u = parseFloat($(this).val())+parseFloat($('#<?php echo $assetpv[1] ?>delay').val())+(parseFloat($(this).val()) * parseFloat($('#<?php echo $assetpv[1] ?>repeat').val()))+(parseFloat($('#<?php echo $assetpv[1] ?>repeatd').val())*parseFloat($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>u);
                    if (<?php echo $assetpv[1] ?>u <= 30) {
                        console.log("gtg");
                        document.getElementById("preview1").disabled = false;
                        document.getElementById("save1").disabled = false;
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>u + " " + "seconds"; 
                    } else {
                        console.log("check duration");
                        document.getElementById("preview1").disabled = true;
                        document.getElementById("save1").disabled = true;
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>u + " " + "seconds" + " " + "Please" + " " + "Check";
                        
                    }

                });
                $('#<?php echo $assetpv[1] ?>delay').keyup(function() {
                    var <?php echo $assetpv[1] ?>v = parseFloat($(this).val())+parseFloat($('#<?php echo $assetpv[1] ?>durn').val())+(parseFloat($('#<?php echo $assetpv[1] ?>durn').val()) * parseFloat($('#<?php echo $assetpv[1] ?>repeat').val()))+(parseFloat($('#<?php echo $assetpv[1] ?>repeatd').val())*parseFloat($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>v);
                    if (<?php echo $assetpv[1] ?>v <= 30) {
                        console.log("gtg");
                        document.getElementById("preview1").disabled = false;
                        document.getElementById("save1").disabled = false;
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>v + " " + "seconds";
                    } else {
                        console.log("check delay");
                        document.getElementById("preview1").disabled = true;
                        document.getElementById("save1").disabled = true;
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>v + " " + "seconds" + " " + "Please" + " " + "Check";
                    }
                });
                $('#<?php echo $assetpv[1] ?>repeatd').keyup(function() {
                    var <?php echo $assetpv[1] ?>w = parseFloat($('#<?php echo $assetpv[1] ?>durn').val()) + parseFloat($('#<?php echo $assetpv[1] ?>delay').val()) + (parseFloat($('#<?php echo $assetpv[1] ?>durn').val()) * parseFloat($('#<?php echo $assetpv[1] ?>repeat').val())) + (parseFloat($(this).val())*parseFloat($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>w);
                    if (<?php echo $assetpv[1] ?>w <= 30) {
                        console.log("gtg");
                        document.getElementById("preview1").disabled = false;
                        document.getElementById("save1").disabled = false;
                        document.querySelector('#<?php echo $assetpv[1] ?>repeatd').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeatd').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>w + " " + "seconds";
                    } else {
                        console.log("check repeat delay");
                        document.getElementById("preview1").disabled = true;
                        document.getElementById("save1").disabled = true;
                        document.querySelector('#<?php echo $assetpv[1] ?>repeatd').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeatd').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>w + " " + "seconds" + " " + "Please" + " " + "Check";
                    }
                });
                $('#<?php echo $assetpv[1] ?>repeat').keyup(function() {
                    var <?php echo $assetpv[1] ?>x = parseFloat($('#<?php echo $assetpv[1] ?>durn').val()) + parseFloat($('#<?php echo $assetpv[1] ?>delay').val()) + (parseFloat($('#<?php echo $assetpv[1] ?>durn').val()) * parseFloat($(this).val())) + (parseFloat($('#<?php echo $assetpv[1] ?>repeatd').val())*parseFloat($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>x);
                    if (<?php echo $assetpv[1] ?>x <= 30) {
                        console.log("gtg");
                        document.getElementById("preview1").disabled = false;
                        document.getElementById("save1").disabled = false;
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>x + " " + "seconds";
                    } else {
                        console.log("check repeat");
                        document.getElementById("preview1").disabled = true;
                        document.getElementById("save1").disabled = true;
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>x + " " + "seconds" + " " + "Please" + " " + "Check";
                    }
                });

            });
            
         
            </script> <?php
 
    }

echo $total;



}
 ?>
</div>
</body>
