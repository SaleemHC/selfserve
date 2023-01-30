<?php
ob_start();
session_start();
include "../conn.php";
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/TweenMax.min.js"></script> -->
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
    .txt_val{
        float: right;
        margin-right: 19%;
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
</style>

<body>
    <button onclick="window.location.href = '../';"><b>Home</b></button>
    <button onclick="history.back()">Go Back</button>
    <div id="demo"></div>
   
</body>

<!-- <?php
        echo '<pre>';
        var_dump($_GET);
        echo '</pre>';
        ?> -->

<?php
$fdate = $_GET['date'];
$fcat = $_GET['fcat'];
$dim = $_GET['dim'];
$client = $_GET['client'];
$id = $_GET['id'];

$_SESSION['animationID'] = $id;
$_SESSION['tableName'] = $client;

$query = "SELECT * from `" . $client . "` WHERE id = '" . $id . "' ";
$result = mysqli_query($connectDB, $query);
$row = mysqli_fetch_assoc($result);

echo "<span class='txt_val' id='showvalue'></span>";
echo "<form method='POST'><table class='table1' id='table1'>
            <thead>
            <tr>
                <td>Assets</td>
                <td>Select Animation <span><img src='./info.png' class='img' title='Select the animation from the select box'></span></td>
                <td style='display:none;'>Opacity <span><img src='./info.png' class='img' title='If its set to 0 then it comes from 0 opacity'></span></td>
                <td class='dn'>Duration <span><img src='./info.png' class='img' title='Total run time of animation'></span></td>
                <td class='dy'>Delay <span><img src='./info.png' class='img' title='Animation will start after some delay'></span></td>
                <td class='ry'>Repeat Delay <span><img src='./info.png' class='img' title='Delay time between start and end of animation'></span></td>
                <td class='ar'>Animation Repeat Count <span><img src='./info.png' class='img' title='The number of times animation will repeat.'></span></td>
               

            </tr></thead><tbody>";
$tab1 = "SELECT * from `" . $row['client'] . "` WHERE id = " . $row['id'] . " ";
$result2 = mysqli_query($connectDB, $tab1);
while ($row1 = mysqli_fetch_assoc($result2)) {
    $json[] = $row1;
}
echo "<tr class='trc'>";
foreach ($json[0] as $key => $x_value) {
    if ($key != 'impression' && $key != 'click' && $key != 'animation' && $key != 'testanim' && $key != 'dim' && $key != 'id' && $key != 'date' && $key != 'client' && $key != 'campaign' && $key != 'fcat' && $x_value != null) {
        $items[] = $key;
        echo "<td>$key</td>";
        echo '<td><select style="width: 100%" name="' . $key . '" id = "' . $key . '1">';
        $sql = "select * from anim";
        $result = mysqli_query($connectDB, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $aname = $row['name'];
            $anim = $row['anim'];
            echo "<option value ='" . $anim . "'>" . $aname . "</option>";
        }

        echo '</select></td>';
        echo "<td style='display:none;'><input type='text' value='0' pattern='[0-1]'  id='" . $key . "opc' name='" . $key . "opc' placeholder='Opacity' class='ropc'></td>";
        echo "<td><input type='text' value='1' id='" . $key . "durn' name='" . $key . "durn' placeholder='Duration' class='rdurn'></td>";
        echo "<td><input type='text' value='1' id='" . $key . "delay' name='" . $key . "delay' placeholder='Delay' class='rdelay'></td>";
        echo "<td><input type='text' value='1' id='" . $key . "repeat_delay' name='" . $key . "repeat_delay' placeholder='repeat delay' class='rclass'></td>";
        echo "<td><input type='number' value='1' id='" . $key . "repeat' name='" . $key . "repeat' placeholder='No.of repeats' class='rnumber'></td></td></tr>";
    }
}
echo "</tbody>";

$ta10 = "SELECT * from $client WHERE id = $id ";
// $ta = "SELECT testanim from `".$row['client']."` WHERE id = ".$row['id']." ";
$result30 = mysqli_query($connectDB, $ta10);
$row30 = mysqli_fetch_assoc($result30);
$tsan10 = $row30['testanim'];
$updateQuery3 = "SELECT * FROM $client where id = $id";
$executeQuery3 = mysqli_query($connectDB, $updateQuery3);

$row4 = mysqli_fetch_assoc($executeQuery3);
$tsan2 = $row4['testanim'];
if ($tsan10 != null) {


    $assetnum = explode('function', $tsan2);
    for ($sal = 1; $sal < count($assetnum); $sal++) {

        $thodo = explode('_', $assetnum[$sal]);
        $assetpv = explode(' ', $thodo[0]);
        $thodojyada = explode('()', $thodo[1]);

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
        // $lpv = count($pv);


        $rp = $pv[0];
        $rp2 = $pv2[0];
        $rp3 = $pv3[0];
        $rp4 = $pv4[0];
        $rp5 = $pv5[0];
        //    echo $rp3;
        //   echo $rp4;
        //    echo $rp5;
        //    echo $rp2;
        //    echo $rp;
        //    echo $thodojyada[0];
?>
        <script>
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
                    var <?php echo $assetpv[1] ?>u = parseInt($(this).val())+parseInt($('#<?php echo $assetpv[1] ?>delay').val())+(parseInt($(this).val()) * parseInt($('#<?php echo $assetpv[1] ?>repeat').val()))+(parseInt($('#<?php echo $assetpv[1] ?>repeat_delay').val())*parseInt($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>u);
                    if (<?php echo $assetpv[1] ?>u <= 30) {
                        console.log("gtg");
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>u + " " + "seconds"; 
                    } else {
                        console.log("check duration");
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>durn').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>u + " " + "seconds" + " " + "Please" + " " + "Check";
                        
                    }

                });
                $('#<?php echo $assetpv[1] ?>delay').keyup(function() {
                    var <?php echo $assetpv[1] ?>v = parseInt($(this).val())+parseInt($('#<?php echo $assetpv[1] ?>durn').val())+(parseInt($('#<?php echo $assetpv[1] ?>durn').val()) * parseInt($('#<?php echo $assetpv[1] ?>repeat').val()))+(parseInt($('#<?php echo $assetpv[1] ?>repeat_delay').val())*parseInt($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>v);
                    if (<?php echo $assetpv[1] ?>v <= 30) {
                        console.log("gtg");
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>v + " " + "seconds";
                    } else {
                        console.log("check delay");
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>delay').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>v + " " + "seconds" + " " + "Please" + " " + "Check";
                    }
                });
                $('#<?php echo $assetpv[1] ?>repeat_delay').keyup(function() {
                    var <?php echo $assetpv[1] ?>w = parseInt($('#<?php echo $assetpv[1] ?>durn').val()) + parseInt($('#<?php echo $assetpv[1] ?>delay').val()) + (parseInt($('#<?php echo $assetpv[1] ?>durn').val()) * parseInt($('#<?php echo $assetpv[1] ?>repeat').val())) + (parseInt($(this).val())*parseInt($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>w);
                    if (<?php echo $assetpv[1] ?>w <= 30) {
                        console.log("gtg");
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat_delay').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat_delay').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>w + " " + "seconds";
                    } else {
                        console.log("check repeat delay");
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat_delay').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat_delay').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>w + " " + "seconds" + " " + "Please" + " " + "Check";
                    }
                });
                $('#<?php echo $assetpv[1] ?>repeat').keyup(function() {
                    var <?php echo $assetpv[1] ?>x = parseInt($('#<?php echo $assetpv[1] ?>durn').val()) + parseInt($('#<?php echo $assetpv[1] ?>delay').val()) + (parseInt($('#<?php echo $assetpv[1] ?>durn').val()) * parseInt($(this).val())) + (parseInt($('#<?php echo $assetpv[1] ?>repeat_delay').val())*parseInt($('#<?php echo $assetpv[1] ?>repeat').val()));
                    console.log(<?php echo $assetpv[1] ?>x);
                    if (<?php echo $assetpv[1] ?>x <= 30) {
                        console.log("gtg");
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.color = "black";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.fontWeight = "400";
                        document.getElementById("showvalue").style.color = "black";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>x + " " + "seconds";
                    } else {
                        console.log("check repeat");
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.color = "red";
                        document.querySelector('#<?php echo $assetpv[1] ?>repeat').style.fontWeight = "700";
                        document.getElementById("showvalue").style.color = "red";
                        document.getElementById("showvalue").innerText = "Totat Animation Time is" + " " + <?php echo $assetpv[1] ?>x + " " + "seconds" + " " + "Please" + " " + "Check";
                    }
                });

            });

        
        </script>
    <?php
    }
} else {
    $row5 = mysqli_fetch_assoc($executeQuery3);
    $tsan3 = $row4['animation'];
    // $pv = explode('();',$tsan3);
    $pv = explode('repeat:', $tsan3);
    // $lpv = count($pv);

    echo $pv[1][0];
}



$col = implode(",", $items);
echo "<input type='hidden' id='hidden1' name='hidden1' value='" . $col . "'>";

echo "</tbody></table><br>";
echo "<button name='preview' id='preview1'    style='border:1px solid black;font-size:15px;cursor:pointer;'>Preview</button>";
echo "<button name='save' id='save1' type='submit' style='border:1px solid black;font-size:15px;cursor:pointer;margin:0 10px;'>Save</button>";
echo "<button name='cancel' id='cancel1'  style='border:1px solid black;font-size:15px;cursor:pointer;'>Cancel</button> </form>";

$ta = "SELECT * from $client WHERE id = $id ";
// $ta = "SELECT testanim from `".$row['client']."` WHERE id = ".$row['id']." ";
$result3 = mysqli_query($connectDB, $ta);
$row3 = mysqli_fetch_assoc($result3);
$tsan = $row3['testanim'];

if (isset($_POST['save'])) {

    if ($tsan != null && $tsan != "") {
        $updateQuery = "UPDATE $client SET animation = '$tsan' where id = $id";
        $executeQuery = mysqli_query($connectDB, $updateQuery);
    } else {
        $updatedAnimation = null;
        $animationID = $_SESSION['animationID'];
        $tableName = $_SESSION['tableName'];

        $ids[] = explode(",", $_POST['hidden1']);
        foreach ($ids[0] as $colname) {

            $ee = $colname . "delay";
            $rdelay = $colname . "repeat_delay";
            $repeat = $colname . "repeat";

            $animvalue = str_replace(array("durn", "opc", "idd", "edelay", "erdelay", "erepeat"), array($_POST[$colname . "durn"], $_POST[$colname . "opc"], $colname, $_POST[$colname . "delay"], $_POST[$colname . "repeat_delay"], $_POST[$colname . "repeat"]), $_POST[$colname]);
            $updatedAnimation = $updatedAnimation . $animvalue;
        }

        $updateQuery = "UPDATE $tableName SET animation = '$updatedAnimation' where id = $animationID";
        $executeQuery = mysqli_query($connectDB, $updateQuery);
    }
    if ($executeQuery) {
        header("location:animation.php?id=" . $id . "&date=" . $fdate . "&client=" . $client . "&fcat=" . $fcat . "&dim=" . $dim . "&update=" . $val . "%2C" . $client);
        ob_end_flush();
    }
}

if (isset($_POST['preview'])) {
    $updatedAnimation = null;
    $animationID = $_SESSION['animationID'];
    $tableName = $_SESSION['tableName'];

    $ids[] = explode(",", $_POST['hidden1']);
    // print_r($_GET['hidden1']);
    foreach ($ids[0] as $colname) {

        // echo $colname."<br>";
        $ee = $colname . "delay";
        $rdelay = $colname . "repeat_delay";
        $repeat = $colname . "repeat";

        // echo "delay".$_GET['bgdelay']."<br>";
        // echo "ee".$_GET[$colname]."<br>";
        $animvalue = str_replace(array("durn", "opc", "idd", "edelay", "erdelay", "erepeat"), array($_POST[$colname . "durn"], $_POST[$colname . "opc"], $colname, $_POST[$colname . "delay"], $_POST[$colname . "repeat_delay"], $_POST[$colname . "repeat"]), $_POST[$colname]);
        $updatedAnimation = $updatedAnimation . $animvalue;

        // echo $executeQuery;


        $tat =  $_POST[$colname . "delay"] + $_POST[$colname . "durn"] + ($_POST[$colname . "durn"] * $_POST[$colname . "repeat"]) + ($_POST[$colname . "repeat_delay"] * $_POST[$colname . "repeat"]);
        $totaltime[] = $tat;
    }

    // print_r(max($totaltime));

    if (max($totaltime) <= 30) {
        $updateQuery = "UPDATE $tableName SET testanim = '$updatedAnimation' where id = $animationID";
        // echo $updateQuery;
        $executeQuery = mysqli_query($connectDB, $updateQuery);
        if ($executeQuery) {
            header("location:animation.php?id=" . $id . "&date=" . $fdate . "&client=" . $client . "&fcat=" . $fcat . "&dim=" . $dim . "&update=" . $val . "%2C" . $client);
            ob_end_flush();
            echo "sucess";
        }
    } else {
    ?> <span style=" position: absolute;top: 175px;left: 158px;color: red;font-size: 17px;"> "Run Time Of Animation Is Above 30 Sec"</span> <?php
    }
    }
    if (isset($_POST['cancel'])) {
       $updateQuery2 = "UPDATE $client SET testanim = '' where id = $id";
       $executeQuery2 = mysqli_query($connectDB, $updateQuery2);
       header("location:animation.php?id=" . $id . "&date=" . $fdate . "&client=" . $client . "&fcat=" . $fcat . "&dim=" . $dim . "&update=" . $val . "%2C" . $client);
       ob_end_flush();
    } ?>


