<?php
    
    session_start();
    
    $id=$_GET['id'];
    if(isset($_POST['id'])) {
        $id=$_GET['id'];
    }
    
    if(isset($_POST['back'])){
        $_SESSION['ast_val'] = 0;
        
        header("location:./uploadassets.php?id=$id");
    }
    // if(isset($_POST['done'])){
    //     // $_SESSION['ast_val'] = 1;
        
    //     $_SESSION['assets_s'] = $_POST['up_st'];
    //     header("location:./uploadassets.php?id=$id");
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Assets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
</head>
    <script src="https://dynamique.hockeycurve.com/js/hc.min.js"> </script>
    
    <body>
        <div id="ast_bx">
            <h4>Assets required to Upload</h4>
            <ul style="list-style:none;padding:0;"></ul>
            <div id="err_bx"></div>
            <input name="up_st" id="updt_vl" type="hidden" />
            <button name="back" onclick="back()">Back to creative</button>
            <span id="btn"></span>
        </div>     
        
<script>
    
    pathurl = localStorage.getItem("path");
    req_assets = localStorage.getItem("asset_req");
    count = localStorage.getItem("count");
    
    req_assets.split(",").forEach(el =>{
        document.querySelector("ul").innerHTML += `<li id="${el}">${el}</li><span id="tick"></span>`;
    })
    
  let assetManager = HC.AssetManager(document.body)
var keyss;
       async function postName() 
   {
  const object = { "paths":[pathurl+'/'] };
  const response = await fetch('https://dynamique.hockeycurve.com/keys?key=Kth7NS3ACWX2', {
    method: 'POST',
    body: JSON.stringify(object)
  });
  const test = await response.json();
  
  keyss=test['data'][0]['key']
   
    assetManager.showFolders([{path:pathurl+'/',key:keyss}])
    
a = await assetManager.getFiles({path:pathurl+'/',key:keyss})
console.log(a)
var img_arr = [];

assetManager.onUpdate((data) => {
   document.querySelector("#err_bx").innerHTML = "";
    data.items.forEach(item => {
        // console.log(item)
        if(req_assets.split(",").includes(item.name)){
            req_assets.split(",").forEach(el =>{
                if(item.name == el){
                    document.querySelector(`#${el}`).innerHTML += '<i class="fa fa-check" aria-hidden="true"></i>';
                    if(!img_arr.includes(item.name)){
                        img_arr.push(item.name);
                    }
                    if(req_assets.split(",").length == img_arr.length){
                        document.querySelector("#btn").innerHTML = `<button onclick="assest()" id="done">Done</button> <span style="color:green"> Assets uploaded successfully</span>`;
                        
                        // window.location.reload();
                    }
                }      
            })
        }
        else{
            document.querySelector("#err_bx").innerHTML += `<span style="color:red;">${item.name} is not the required asset for the creative please check</span><br>`;
        }
    })
})
    a.forEach(al => {
        var img_nm = al.Key.substring(al.Key.lastIndexOf('/')+1).split('.')[0];
        if(req_assets.split(",").includes(img_nm)){
            img_arr.push(img_nm)
            req_assets.split(",").forEach(el =>{
                if(img_nm == el){
                    document.querySelector(`#${el}`).innerHTML += '<i class="fa fa-check" aria-hidden="true"></i>';
                    // echo "<h2 style:"color:green">uploaded successfully</h2>"; 
                }
            })
            
            if(req_assets.split(",").length == img_arr.length){
                         var vn = JSON.stringify(a);
                        //  console.log(vn);
                         document.querySelector("#updt_vl").value = vn;
                        document.querySelector("#btn").innerHTML = `<button onclick="assest()" id="done">Done</button> <span style="color:green"> Assets uploaded successfully</span>`;
                    }
        }
    })
    
    
   }
postName();
async function assest(){
    var aw_ast = await assetManager.getFiles({path:pathurl+'/',key:keyss})
    var vna = JSON.stringify(aw_ast);
    var stat = "dim"+pathurl.split("/")[2]
    localStorage.setItem("assets",vna);
    localStorage.setItem("count",count);
    localStorage.setItem("stat"+stat,stat);
    window.location = "./creative.php?id=<?php echo $id; ?>";
}

function back(){
    window.location = "./creative.php?id=<?php echo $id; ?>";
    
    localStorage.setItem("count",count);
}

</script>

</body>
</html>