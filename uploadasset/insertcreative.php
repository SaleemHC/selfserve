<?php 

    include "../conn.php";
    session_start();
    error_reporting(E_ERROR | E_PARSE);

    $id = $_POST['id'];
    $count = $_POST['count'];
    $content = $_POST['content'];
    $fcat = $_POST['fcat'];
    $asset_r = $_POST['asset_r'];
    
    $sql="SELECT * FROM `campaign_info` WHERE id='$id'";
    $data=mysqli_query($connectDB,$sql);
    if(mysqli_num_rows($data)>0){
        while($row=mysqli_fetch_assoc($data)){
                $camp =  $row['campaign_name'];
                $client =  $row['client_name'];
                $temp = $row['template'];
                $exp_dim = explode(",",$row['dimension']);
                $single_dim = $exp_dim[$count];

                $sql_creatcode = "SELECT * FROM `creativecode` WHERE client='$client' AND campaign='$camp' AND dimension='$single_dim'";
                $data_creatcode=mysqli_query($connectDB,$sql_creatcode);
                if(mysqli_num_rows($data_creatcode)>0){
                    while($row_creatcode=mysqli_fetch_assoc($data_creatcode)){
                        $id_creatcode=$row_creatcode['id'];
                        $sql_update = "UPDATE creativecode SET content='$content',finalcode='$content' WHERE id='$id_creatcode'";
                        $data_update=mysqli_query($connectDB,$sql_update);                        
                    }

                    $resp = array("status"=>true,"message"=>"Updated Code");
                    echo json_encode($resp);
                     
                }else{
                    // Inserting Creative in DB
                    $sql_insert = "INSERT INTO creativecode (name,campaign,type,cdata,client,dimension,filter,status,content,finalcode,clicks,impressions,asset_used) VALUES ('$temp','$camp','static','popular','$client','$single_dim','$fcat','active','$content','$content','landing_url','imperession_trk','$asset_r')";
                    $data_insert=mysqli_query($connectDB,$sql_insert);

                    $resp = array("status"=>true,"message"=>"Inserted Code","asset"=>$asset_r);
                    echo json_encode($resp);
                }
    }}
?>