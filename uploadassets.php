<?php
    
    session_start();
    $paths = $_SESSION['path'];

echo $paths;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Assets</title>
</head>
    <script src="https://dynamique.hockeycurve.com/js/hc.min.js"> </script>
    
    <body>
        <p>
            Required Assets to upload
        </p>
<script>
    
  let assetManager = HC.AssetManager(document.body)

       async function postName() 
   {
  const object = { "paths":["clienttest/mzindodi22/300x600/"] };
  const response = await fetch('https://dynamique.hockeycurve.com/keys?key=Kth7NS3ACWX2', {
    method: 'POST',
    body: JSON.stringify(object)
  });
  const test = await response.json();
  
  var keyss=test['data'][0]['key']
   
    assetManager.showFolders([{path:'clienttest/mzindodi22/300x600/',key:keyss}])

await assetManager.getFiles({path:'clienttest/mzindodi22/300x600/',key:keyss})
assetManager.onUpdate((data) => console.log('data updated just now', data))
    
   }
postName();
</script>

</body>
</html>