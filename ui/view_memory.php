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

$memoriesJson = file_get_contents('../json/memories.json');
$memoriesArray = json_decode($memoriesJson, true);
$array_length = count($memoriesArray);

// FIND WHICH BUTTON WAS CLICKED
for ($i = 0; $i < $array_length; $i++)
{
		$submit_name = "submit_";
		$submit_name .= strval($i);
		//echo $submit_name;
		$check = isset($_GET[$submit_name]);

		if ($check == 1)
				$index = $i;
}

// GET CORRESPONDING MEMORY
$name = $memoriesArray[$index]["name"];
$memory = $memoriesArray[$index]["memory"];
$category = $memoriesArray[$index]["category"];

?>

    <body id="body3">

    	<div class="left_bar3">
    		<img src="../img/button/heading2.png" style="height: 600px; margin-top: 100px; margin-left: 20px;" alt="" />
    	</div>

    	<button class="closeBtn" id= "close" type="button"><a href="memory_list.php">
    			<img src="../img/button/close.png" style="width: 50px; background-color: transparent;" alt="" />
    		</a>
    	</button>

    	<div id="sketch-holder">
    		<!-- Our sketch will go here! -->
    	</div>
      </body>

<script>
var memory_data = '<?php echo json_encode($memory); ?>';
var text = JSON.parse(memory_data);
setInputText(text);
play();
var category_data = '<?php echo json_encode($category); ?>'
var cat = JSON.parse(category_data);
setRandomColoursByCategory(cat);
</script>


</html>
