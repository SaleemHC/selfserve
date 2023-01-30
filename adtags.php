<?php
include "conn.php";
error_reporting(E_ERROR | E_PARSE);
$id=$_GET['id'];
if(isset($_POST['id'])) {
    $id=$_GET['id'];
}
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
    <title>adtags</title>
    <style>
        #btn {
            margin-left: 25px;
        }
    </style>
</head>

<body>
    <div>
    <?php 
$sql="SELECT * FROM `adtagdata` WHERE id=$id LIMIT 1";
$result=mysqli_query($connectDB,$sql);
$row=mysqli_fetch_assoc($result);
?>
        <h2 style="margin-left: 25px;"><?php echo $row['campaign_name']?></h2>
        <br><br>
        <!-- <button id="btn" onclick="history.back()">back</button> -->
        <button onclick="location.href = 'preview.php?id=<?php echo $row['id']?>';">
        Preview</button>
    </div>
    <br>
    <div id="adtags_table" class="container">
        <table id="tabledata" class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th style="width:100px">fcats</th> -->
                    <th style="width:100px">dimension</th>
                    <th style="width:550px">Tags</th>
                    <th style="width:30px"></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    $dims=$row['dims'];
                    $str_arr = explode (",", $dims); 
                    $i = 0;
                    while($i < count($str_arr))
                {$wh_dim=explode("x",$str_arr[$i])?>
                    <tr>
                    <!-- <td><?php echo $row['fcat']?></td>      -->
                    <td><?php echo $str_arr[$i]?></td>
                    <td><div id="sample<?php echo $i ?>"><?php
                    if ($row["fcat_n"]==""){                                                 
                        if ($row["geo"]==""){                                                 
                            if($row["adtag_type"]=="DCM"){
                           ?>&lt;div class='hockeycurve-v1'><br>
                           &lt;iframe id='main-ad-tag' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe><br>
                           &lt;script type='text/javascript'><br>
                           var params = {'client':'<?php echo $row['client']?>','fcat':'<?php echo $row['fcat']?>','ct0':'%c_esc', 'lp0':'%u','cb':'%n','dbmc':'<?php echo $row['fcat']?>'}<br>
                           var cs = '';<br>
                           for (var p in params) {<br>
                           cs += '&' + encodeURIComponent(p) + '=' + encodeURIComponent(params[p<br>
                           ]);<br>
                           }<br>
                           var final_src = 'https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&partner=dcm&optout=false' + cs<br>
                           document.getElementById('main-ad-tag').src = final_src<br>
                           &lt;/script><br>
                           &lt;/div>
                             <?php }
                             else if($row["adtag_type"]=="Dv360"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                             <?php }
                             else if($row["adtag_type"]=="Dv360Dbmc"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=<?php echo $row['fcat']?> frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                             <?php }
                             else if($row["adtag_type"]=="DFP"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                             <?php }
                             else if($row["adtag_type"]=="CRITEO"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''>&lt;/iframe>
                             <?php }
                             else if($row["adtag_type"]=="Sports"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER} frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                           <?php }
                           }
                           else if ($row["geo"]=="true"){
                             if($row["adtag_type"]=="DCM"){ ?>
                               &lt;div class='hockeycurve-v1'><br>
                               &lt;iframe id='main-ad-tag' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe><br>
                               &lt;script type='text/javascript'><br>
                               var params = {'client':'<?php echo $row['client']?>','fcat':'<?php echo $row['fcat']?>','geo':'true','ct0':'%c_esc', 'lp0':'%u','cb':'%n','dbmc':'<?php echo $row['fcat']?>'}<br>
                               var cs = '';<br>
                               for (var p in params) {<br>
                               cs += '&' + encodeURIComponent(p) + '=' + encodeURIComponent(params[p<br>
                               ]);<br>
                               }<br>
                               var final_src = 'https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&partner=dcm&optout=false' + cs<br>
                               document.getElementById('main-ad-tag').src = final_src<br>
                               &lt;/script><br>
                               &lt;/div>
                               <?php }
                               else if($row["adtag_type"]=="Dv360"){ ?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                               <?php }
                               else if($row["adtag_type"]=="Dv360Dbmc"){ ?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=<?php echo $row['fcat']?> frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                               <?php }
                               else if($row["adtag_type"]=="DFP"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=true&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                               <?php }
                               else if($row["adtag_type"]=="CRITEO"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=true&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''>&lt;/iframe>
                               <?php }
                               else if($row["adtag_type"]=="Sports"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                             <?php }}
                             else if ($row["geo"]=="bcamp")
                             {
                                 if($row["adtag_type"]=="DCM"){
                                   ?>&lt;div class='hockeycurve-v1'><br>
                                     &lt;iframe id='main-ad-tag' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe><br>
                                     &lt;script type='text/javascript'><br>
                                     var params = {'client':'<?php echo $row['client']?>','fcat':'<?php echo $row['fcat']?>','geo':'bcamp','ct0':'%c_esc', 'lp0':'%u','cb':'%n','dbmc':'<?php echo $row['fcat']?>'}<br>
                                     var cs = '';<br>
                                     for (var p in params) {<br>
                                     cs += '&' + encodeURIComponent(p) + '=' + encodeURIComponent(params[p<br>
                                     ]);<br>
                                     }<br>
                                     var final_src = 'https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&partner=dcm&optout=false' + cs<br>
                                     document.getElementById('main-ad-tag').src = final_src<br>
                                     &lt;/script><br>
                                     &lt;/div>
                                 <?php }
                                 else if($row["adtag_type"]=="Dv360"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                 <?php }
                                 else if($row["adtag_type"]=="Dv360Dbmc"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=<?php echo $row['fcat']?>' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                 <?php }
                                 else if($row["adtag_type"]=="DFP"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=bcamp&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                 <?php }
                                 else if($row["adtag_type"]=="CRITEO"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=bcamp&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''>&lt;/iframe>
                                 <?php }
                                 else if($row["adtag_type"]=="Sports"){?>
     &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                 <?php }
                                 }}
                            else if($row["fcat_n"]=="fcat_nan"){
                                if ($row["geo"]==""){                                                 
                                    if($row["adtag_type"]=="Dv360"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                     <?php }
                                     else if($row["adtag_type"]=="DFP"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                     <?php }
                                     else if($row["adtag_type"]=="CRITEO"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client']?>&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''>&lt;/iframe>
                                     <?php }
                                     else if($row["adtag_type"]=="Sports"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                   <?php }
                                   }
                                   else if ($row["geo"]=="true"){
                                    if($row["adtag_type"]=="Dv360"){ ?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                       <?php }
                                       else if($row["adtag_type"]=="DFP"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&geo=true&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                       <?php }
                                       else if($row["adtag_type"]=="CRITEO"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client']?>&geo=true&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''>&lt;/iframe>
                                       <?php }
                                       else if($row["adtag_type"]=="Sports"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                     <?php }}
                                     else if ($row["geo"]=="bcamp")
                                     {
                                        if($row["adtag_type"]=="Dv360"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                         <?php }
                                         else if($row["adtag_type"]=="DFP"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&geo=bcamp&partner=dbm&optout=false&ct0=%%CLICK_URL_ESC%%&cb=%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                         <?php }
                                         else if($row["adtag_type"]=="CRITEO"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=Jpeg&client=<?php echo $row['client']?>&geo=bcamp&partner=dbm&optout=false&ct0=${{clickurl}}&cb=${{random}}%%CACHEBUSTER%%&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='Jpeg' height=''>&lt;/iframe>
                                         <?php }
                                         else if($row["adtag_type"]=="Sports"){?>
             &lt;iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'>&lt;/iframe>
                                         <?php }
                                         }
                            }
                      ?></td>
                      <td><button onclick="CopyToClipboard('sample<?php echo $i ?>')";>Copy Text</button></td>
                </tr>
                <?php
	                $i++;
                }
                ?>  

            </tbody>
        </table>
        <button id="tabledownload">Download csv</button>
        <button onclick="demoFromHTML()">Download pdf</button>
        <button onclick="ExportToExcel('xlsx')">Download excel</button>
        </div>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script type="text/javascript">
  $("#tabledownload").click(function(){
 $('#tabledata').table2csv({

  file_name:'adtags.csv',

  header_body_space: 0

});
});

function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('adtags_table');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('adtag.' + (type || 'xlsx')));
    }
function CopyToClipboard(id)
{
var r = document.createRange();
r.selectNode(document.getElementById(id));
window.getSelection().removeAllRanges();
window.getSelection().addRange(r);
document.execCommand('copy');
window.getSelection().removeAllRanges();
}

  function demoFromHTML() {
    var pdf = new jsPDF('l', 'px', 'tabloid');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#adtags_table')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Adtag.pdf');
    }, margins);
}


</script>
</body>

</html>