<?php 

    include "../conn.php";
    session_start();
    // error_reporting(E_ERROR | E_PARSE);

    $id = $_POST['id'];
    $count = $_POST['count'];
    $stat = true;

    $output = "";

    $sql="SELECT * FROM `campaign_info` WHERE id='$id'";
    $data=mysqli_query($connectDB,$sql);
    if(mysqli_num_rows($data)>0){
        while($row=mysqli_fetch_assoc($data)){
            $template = $row['template'];
            $dimension = $row['dimension']; 
            $camp =  $row['campaign_name'];
            $client =  $row['client_name'];
            $adtagtype = $row['adtag_type'];
           

            $ep_dim = explode(",",$dimension);
            $dim_count = count($ep_dim);
            $single_dim = $ep_dim[$count];

            $sql_creatcode = "SELECT * FROM `creativecode` WHERE client='$client' AND campaign='$camp' AND dimension='$single_dim'";
            $data_creatcode=mysqli_query($connectDB,$sql_creatcode);

            if(mysqli_num_rows($data_creatcode)>0){
                $sql_temp="SELECT * FROM `templates` WHERE template_name='$template' AND dim='$single_dim'";
                $data_temp=mysqli_query($connectDB,$sql_temp);
                $row_temp=mysqli_fetch_assoc($data_temp);
                $asset_req = $row_temp['assets_req'];
                $script = $row_temp['script_tags'];
                $style_in = explode(",",$row_temp['css_style']);
                $align_in;
                $im_lp_in;
                
                foreach($style_in as $cv){
                    if(strpos($cv, 'color')){
                        $align_in .= "<label>{$cv}</label><input id='{$cv}' type='color' /></br>";
                    }else if(strpos($cv, 'tracker')  || strpos($cv, 'url')){
                        "<input type='hidden' />";
                    }else if($cv != ""){
                        $align_in .= "<label>{$cv}</label><input id='{$cv}' type='text' /></br>";
                    }
                }

                foreach($style_in as $av){
                    if(strpos($av, 'tracker')  || strpos($av, 'url')){
                        $im_lp_in .= "<label>{$av}</label><input id='{$cv}' type='text' /></br>";
                    }
                }
                
                while($row_creatcode=mysqli_fetch_assoc($data_creatcode)){
                    $temp_cre = $row_creatcode['name'];
                        $dim_cre = $row_creatcode['dimension'];
                        $content_cre = $row_creatcode['content'];
                        
                        if($align_in != null){
                            $algn_var = "<th class='hide'>Alignment</th>";
                            $algn_td = "<td class='hide'>
                                            {$align_in}
                                        </td>";
                        }
                        
                        if($im_lp_in != null && $adtagtype!="dcm"){
                            $imlp_var = "<th class='hide'>Landing URL/Impression Tracker</th>";
                            $impl_td = "<td class='hide'>
                                            {$im_lp_in}
                                        </td>";
                        }
                        
                        $output = "
                            <h3 style='text-align:center;margin: 10px;'>{$temp_cre}</h3>
                            <h4 style='text-align:center;margin: 10px;'>{$dim_cre}</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ad Size</th>
                                        <th>Previews</th>
                                        <th>Upload Assets</th>
                                        {$algn_var}
                                        {$imlp_var}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style='position:relative;text-align:center;'>{$dim_cre}</td>
                                        <td style='position:relative;width:180px;height:180px;overflow:hidden;'>
                                            <div id='aspectRatio' style='position:absolute;top:0;left:0'>
                                                {$content_cre}
                                            </div>
                                        </td>
                                        <td style='position:relative;text-align:center;'>
                                            <button id='upload_assets'>Upload</button>
                                        </td>
                                        {$algn_td}
                                        {$impl_td}
                                    </tr>
                                </tbody>
                            </table>
                        ";
                    
            }
            $path = "$client/$camp/$single_dim";
            $resp = array("status"=>true,"content"=>$output,"path"=>$path,"assets"=>$asset_req,"dimCnt"=>$dim_count,"style_in"=>$style_in,"script"=>$script);
            echo json_encode($resp);
            }
            else{
                $sql_temp="SELECT * FROM `templates` WHERE template_name='$template' AND dim='$single_dim'";
                $data_temp=mysqli_query($connectDB,$sql_temp);
                if(mysqli_num_rows($data_temp)>0){
                    while($row_temp=mysqli_fetch_assoc($data_temp)){
                        $temp = $row_temp['template_name'];
                        $dim = $row_temp['dim'];
                        $content = $row_temp['master_code'];
                        $asset_req = $row_temp['assets_req'];
                        $style_in = explode(",",$row_temp['css_style']);
                        
                        if($align_in != null){
                            $algn_var = "<th class='hide'>Alignment</th>";
                            $algn_td = "<td class='hide'>
                                            {$align_in}
                                        </td>";
                        }
                        
                        if($im_lp_in != null){
                            $imlp_var = "<th class='hide'>Landing URL/Impression Tracker</th>";
                            $impl_td = "<td class='hide'>
                                            {$im_lp_in}
                                        </td>";
                        }

                        $output = "
                            <h3 style='text-align:center;margin: 10px;'>{$temp}</h3>
                            <h4 style='text-align:center;margin: 10px;'>{$dim}</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ad Size</th>
                                        <th>Previews</th>
                                        <th>Upload Assets</th>
                                        {$algn_var}
                                        {$imlp_var}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style='position:relative;text-align:center;'>{$dim}</td>
                                        <td style='position:relative;width:180px;height:180px;overflow:hidden;'>
                                            <div id='aspectRatio' style='position:absolute;top:0;left:0'>
                                                {$content}
                                            </div>
                                        </td>
                                        <td style='position:relative;text-align:center;'>
                                            <button id='upload_assets'>Upload</button>
                                        </td>
                                        {$algn_td}
                                        {$impl_td}
                                    </tr>
                                </tbody>
                            </table>
                        ";
                    }
                    $path = "$client/$camp/$single_dim";
                    $resp = array("status"=>true,"content"=>$output,"path"=>$path,"assets"=>$asset_req,"dimCnt"=>$dim_count,"style_in"=>$style_in,"script"=>$script,"type"=>$adtagtype);
                    echo json_encode($resp);
                }else{
                    echo "<span>Error</span>";
                }
            }
            
        }
    }else{
        echo "<span>Hello</span>";
    }
?>