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
<script type="text/javascript" src="../js/sound_and_vision.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Orbitron" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<!--
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style_old.css">
-->
<?php

$memoriesJson = file_get_contents('../../json/memories.json');
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

  <div class="nav">
    <a href="memory_list.php">
      <img class="nav" src="../img/button/close.png" style="width: 30px;" alt="" />
    </a>
  </div>

  <div class="flex-center" style="width:100%">
    <h1 class="memory-title">View Memory</h1>
    <h2>Memory #0<span id="name"><?php echo $index + 1 ?></span><br /></h2>

    <div id="sketch-holder">
      <!-- Our sketch will go here! -->
    </div>
<!--
    <a href="choice.html">
      <div class="svg-wrapper-light purple" style="border: solid 5px var(--cpurple); margin-top: 80px;">
        <div class="button-text-light" style="top:12px; color:white">Continue</div>
      </div>
    </a>-->
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
