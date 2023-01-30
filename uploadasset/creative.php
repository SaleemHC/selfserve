
<?php

    session_start();
    // error_reporting(E_ERROR | E_PARSE);
    $id=$_GET['id'];
    if(isset($_POST['id'])) {
        $id=$_GET['id'];
    }

    $fcat = $_SESSION['fcat'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <title>Upload Assets</title>

    <style>
        #creative_table{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items: center;
        }
        table{
            width: 80%; 
        }
        table,tr,td,th{
            border: 1px solid #000;
        }

        .upd_ast{
            position: absolute;
            /* top:0; */
            display: none;
            border: 1px solid #000;
            padding: 8px;
            background: #fff;
        }

        .upd_ast.active{
            display: block;
        }

        ul{
            text-align: left;
            list-style: none;
            padding: 0;
        }

        .align_stl{
            display: none;
        }
        .align_stl.active{
            display: block;
        }

        .hide{
            display: none;
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
</head>
<body>
    <div id="creative_box">
        <ul class="list-unstyled multi-steps">
    <li>Registration form</li>
    <li>Login</li>
    <li>Campaign information</li>
    <li>select template</li>
    <li class="is-active">Upload assets</li>
    <li>Update animation</li>
    <li>Previews/Adtags</li>
  </ul>
  <a href="../logout.php" class="btn btn-danger" style="position:absolute;top:5px;right:5px">Logout</a>
        <h2 style="text-align:center;">Upload Assets</h2>
        <h3 style="text-align:center;margin: 5px;">Selected Template Name</h3>
        <div id="save_nxt_btn">
            <button id="back">Back</button>
            <button id="sv_nxt">Save & Next</button>
            <button id="home">Home</button>
        </div>
        <div id="creative_table"></div>
    </div>
</body>
<script>
    
    var count = localStorage.getItem("count") || 0;
    var path = "";
    var asset_req = "";
    var dim_count;
    var style_in;

    $(document).ready(function(){
      
    function loadCreative(){
        $.ajax({
            url : "loadcreative.php",
            type : "POST",
            dataType: "JSON",
            data: {
                id:  "<?php echo $id; ?>",
                count: count,
            },
            success : function(dt){
                console.log(dt)
                $("#creative_table").html(dt.content);
                $("head").append(dt.script)
                path = dt.path;
                localStorage.setItem("path",path);
                asset_req = dt.assets;
                dim_count = dt.dimCnt;
                style_in = dt.style_in;

                var dim_split = path.split("/")[2]
                // Aspect Ratio
                let aspectRatio = document.querySelector("#aspectRatio");
                let width_bx;
                let height_bx;
                
                // Spliting width and height
                var dim_sp = dim_split.split("x")
                width_bx = dim_sp[0]
                height_bx = dim_sp[1]
                
                // aspect condition 
                if(width_bx > height_bx || Number(width_bx) > Number(height_bx)){
                    var scale_vl = 180/Number(width_bx);
                    aspectRatio.style.transform=`scale(${scale_vl.toFixed(2)})`;
                }else{
                    var scale_vl = 180/Number(height_bx);
                    aspectRatio.style.transform=`scale(${scale_vl.toFixed(2)})`;
                }

                var d = path.split("/")[2];
                if("dim"+d == localStorage.getItem("statdim"+d)){
                    console.log("hello")
                    algn_hd = document.querySelectorAll(".hide")
                    algn_hd.forEach(el => {
                        el.style.display="table-cell";
                    });
                }
                
                localStorage.setItem("count",count);
            }
        });

        

    }

    
    loadCreative();
        if(localStorage.getItem("assets") != "" && localStorage.getItem("assets") != null){
            var asst_url = JSON.parse(localStorage.getItem("assets"))
            path = localStorage.getItem("path")
            count = localStorage.getItem("count")
            a_rq = localStorage.getItem("asset_req")
            
            var dim_url = path.split("/")[2]
            var dim_wd = dim_url.split("x")[0]
            loadCreative();
            setTimeout(() => {
                var box_dy = document.getElementById("dynadata"+dim_url);
                box_dy.innerHTML = ""
                asst_url.forEach(el => {
                    var ast_id = el.Key.substring(el.Key.lastIndexOf('/')+1).split('.')[0]
                    a_rq.split(",").forEach(ar => {
                        if(ar == ast_id){
                            box_dy.innerHTML += `<img id="${ast_id}" style="position:absolute;width:${dim_wd}px;" src="https://s.hcurvecdn.com/${el.Key}?${el.LastModified}" />`
                        }
                    })
                });
                insertCreative();
                // loadCreative();                
            localStorage.setItem("assets","");
            window.location.reload();
            }, 500);
            // loadCreative(); 
        }
        
    function insertCreative(){
        var creative_code = $("#aspectRatio").html();
        $.ajax({
            url : "insertcreative.php",
            type : "POST",
            dataType: "JSON",
            data: {
                id:  "<?php echo $id; ?>",
                count: count,
                content: creative_code.trim(),
                fcat: "<?php echo $fcat; ?>",
                asset_r: asset_req,
            },
            success : function(dt){
                console.log(dt)
            }
        });       
    }    

    $("#sv_nxt").on("click",function(e){
        e.preventDefault();
        if(count < dim_count){
            insertCreative();
            count++;
            loadCreative();
        }
        if(count == (dim_count-1)){     
            $("#sv_nxt").text("Proceed");
        }
        if(count == dim_count){
            localStorage.setItem("count",0);  
            window.location = "../update/update.php?id=<?php echo $id; ?>";
        }
    })

    $(document).on("click","#upload_assets",function(e){
        e.preventDefault();
        localStorage.setItem("path",path);
        localStorage.setItem("count",count);    
        localStorage.setItem("asset_req",asset_req);   
        window.location = "./uploadimage.php?id=<?php echo $id; ?>";
    })

    $("#back").on("click",function(e){
        e.preventDefault();
        if(count > 0){
            console.log(dim_count)
            count--;
            loadCreative();    
            $("#sv_nxt").text("Save & Next");
        }else if(count<=0){
            window.location = "../template/index.php?id=<?php echo $id; ?>";
        }
    })
    
    $("#home").on("click",function(e){
        e.preventDefault();
        window.location = "../index.php";
    })

    
  
    });
</script>
</html>

