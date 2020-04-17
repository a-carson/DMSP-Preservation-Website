<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/tone"></script>
<script type="text/javascript" src='javascript/ascii_sonification.js'> </script>
</head>

<body>

  <?php
    // JSON string
    $memoriesJson = file_get_contents('json/memories.json');
    // Convert JSON string to Array
    $memoriesArray = json_decode($memoriesJson, true);

    for ($i = 0; $i < sizeof($memoriesArray); $i++)
    {
    echo $memoriesArray[$i]["name"];
    echo " : ";
    echo $memoriesArray[$i]["category"];
    echo " : ";
    echo $memoriesArray[$i]["memory"];
    echo "<br>";
    }
  ?>

<div class="mypanel"></div>

</body>

<script>
var js_data = '<?php echo json_encode($memoriesArray[0]["memory"]); ?>'
var  text = JSON.parse(js_data);
$(".mypanel").html(text);
sonify(text);
</script>

</html>
