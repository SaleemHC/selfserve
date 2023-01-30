<?php

include "../conn.php";

$sql = "SELECT * FROM templates WHERE template_name = '{$_POST['template']}' LIMIT 1 ";
$result = mysqli_query($connectDB, $sql) or die("SQL Query Failed.");

$output = "";
?>


<form method="POST" >
<?php
if(mysqli_num_rows($result) > 0 ){
  $output .= '
  Select Dimension : <select name="dim[]" id="templates_drop" multiple="multiple" title="Select Dimension">
  ';
  $sql1 = "SELECT * FROM templates WHERE template_name = '{$_POST['template']}'";
$result1 = mysqli_query($connectDB, $sql1) or die("SQL Query Failed.");
  while($row1 = mysqli_fetch_assoc($result1)){
    $output.="<option value='{$row1['dim']}'>{$row1['dim']}</option>";
  }
  $output.='
  </select>
  
  <table style="margin:30px">
              <tr>
                <th style=" padding: 15px;width:200px;">Template name</th>
                <th style=" padding: 15px;width:400px;">Default AD</th>
                <th style=" padding: 15px;">Dimension</th>
                
              </tr>';
  while($row = mysqli_fetch_assoc($result)){
    $dim=$row['dim'];
    $output .= "<tr>
                  <td style='padding: 15px;width:200px;'>{$row["template_name"]}</td><input type='hidden' name='temp' value='{$row["template_name"]}'>
                  <td style='position:relative;width:200px;height:200px;padding: 15px;'><div id='aspectRatio' style='position:absolute;top:0;left:0;'>{$row["master_code"]}</div></td>
                  <td style='padding: 15px;'>{$row["dim"]}</td>
                
                </tr>";
  }    
   $output .= "</table>
   <button style='float:right' class='btn btn-success' onclick='clickchange()' type='submit' name='submit'>Submit</button>
   </form>";

   echo $output;
}else{
    echo "No Record Found.";
}
?>
<?php
$autofcats2 = "";
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
  $charCount = strlen($characters);
  for($i=0;$i<6;$i++){
    $autofcats2 .= substr($characters,rand(0,$charCount),1);}
?>

<script>

let $select<?php echo $autofcats2 ?> = $('#templates_drop').multiselect({
  enableFiltering: true,
  includeFilterClearBtn: true,
  enableCaseInsensitiveFiltering: true
  
});
    </script>

<script>
  let aspectRatio<?php echo $autofcats2 ?> = document.getElementById("aspectRatio");
    let dim<?php echo $autofcats2 ?> = "<?php echo $dim; ?>"
    console.log(dim<?php echo $autofcats2 ?>);
    let width_bx<?php echo $autofcats2 ?>;
    let height_bx<?php echo $autofcats2 ?>;
    
    // Spliting width and height
    width_bx<?php echo $autofcats2 ?> = dim<?php echo $autofcats2 ?>.split("x")[0]
    height_bx<?php echo $autofcats2 ?> = dim<?php echo $autofcats2 ?>.split("x")[1]

    // aspect condition 
    if(Number(width_bx<?php echo $autofcats2 ?>) > Number(height_bx<?php echo $autofcats2 ?>)){
        var scale_vl<?php echo $autofcats2 ?> = 200/Number(width_bx<?php echo $autofcats2 ?>);
        aspectRatio<?php echo $autofcats2 ?>.style.transform=`scale(${scale_vl<?php echo $autofcats2 ?>})`;
       
    }else{
        var scale_vl<?php echo $autofcats2 ?> = 200/Number(height_bx<?php echo $autofcats2 ?>);
        aspectRatio<?php echo $autofcats2 ?>.style.transform=`scale(${scale_vl<?php echo $autofcats2 ?>})`;
        
    }


</script>