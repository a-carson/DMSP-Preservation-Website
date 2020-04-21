<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Distorted Memories</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.1/addons/p5.dom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.1/addons/p5.sound.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/tone"></script>
<script type = "text/javascript" src = "../js/sound_and_vision.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Orbitron" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style_old.css">

    <?php
    
    $name = test_for_hackers($_POST["name"]);
    $category = test_for_hackers($_POST["category"]);
    $memory = test_for_hackers($_POST["memory"]);

    // new entry
    $newEntry = array(
      "name" => $name,
      "category" => $category,
      "memory" => $memory,
    );

      // get json
    $memoriesJson = file_get_contents('../json/memories.json');
    // Convert JSON string to Array
    $memoriesArray = json_decode($memoriesJson, true);
    // append new entry
    $memoriesArray[] = $newEntry;
    // encode and write to json
    $encodedArray = json_encode($memoriesArray);
    file_put_contents('../json/memories.json', $encodedArray);

    function test_for_hackers($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    ?>

    <body id="body3">

    	<div class="left_bar3">
    		<img src="../img/button/heading2.png" style="height: 600px; margin-top: 100px; margin-left: 20px;" alt="" />
    	</div>

    	<button class="closeBtn" type="button"><a href="choice.html">
    			<img src="../img/button/close.png" style="width: 50px; background-color: transparent;" alt="" />
    		</a>
    	</button>

    	<div id="sketch-holder">
    		<!-- Our sketch will go here! -->
    	</div>
      </body>

<script>
var memory_data = '<?php echo json_encode($memory); ?>'
var text = JSON.parse(memory_data);
setInputText(text);
play();
var category_data = '<?php echo json_encode($category); ?>'
var cat = JSON.parse(category_data);
setRandomColoursByCategory(cat);

</script>


</html>
