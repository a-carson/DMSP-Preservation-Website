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
		// GET JSON
		$memoriesJson = file_get_contents('../json/memories.json');
		$memoriesArray = json_decode($memoriesJson, true);

		// GET FORM DATA
    $name = test_for_hackers($_POST["name"]);
    $category = test_for_hackers($_POST["category"]);
    $memory = test_for_hackers($_POST["memory"]);

    // ADD FORM DATA TO ARRAY
    $newEntry = array(
      "name" => $name,
      "category" => $category,
      "memory" => $memory,
    );
    $memoriesArray[] = $newEntry;

    // WRITE TO JSON
    $encodedArray = json_encode($memoriesArray);
    file_put_contents('../json/memories.json', $encodedArray);

		// RANDOM COLOUR GENERATION
		$h = array_fill(0, 8, 0);
		$s = array_fill(0, 8, 0);
		$b = array_fill(0, 8, 0);
		$offset = 0;
		$range = 90;

		if ($category == 'travel')
			{
				// yellow
				$offset = 0;
				$range = 90;
			}
		if ($category == 'others')
			{
				// green
				$offset = 90;
				$range = 90;
			}
		if ($category == 'student-life')
			{
				// blue
				$offset = 180;
				$range = 90;
			}
		if ($category == 'childhood')
			{
				// pink
				$offset = 270;
				$range = 90;
			}

		for ($j = 0; $j < 8; $j++)
			{
					$h[$j] = $offset + rand(0, $range);
					$s[$j] = rand(70, 360);
					$b[$j] = rand(210, 360);
			}

		// GET COLOURS JSON
		$coloursJson = file_get_contents('../json/colours.json');
		$coloursArray = json_decode($coloursJson, true);

		// APPEND TO ARRAY
		$newColourEntry = array("h" => $h,"s" => $s,"b" => $b);
		$coloursArray[] = $newColourEntry;

		// WRITE TO COLOURS JSON
		$encodedArrayColours = json_encode($coloursArray);
		file_put_contents('../json/colours.json', $encodedArrayColours);

    function test_for_hackers($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
			$data = str_replace("'", '', $data);
			$data = str_replace('"', '', $data);
      return $data;
    }


    ?>

		<body id="body3">

		  <div class="nav">
		    <a href="memory_list.html">
		      <img class="nav" src="img/button/close.png" style="width: 30px;" alt="" />
		    </a>
		  </div>

		  <div class="flex-center" style="width:100%">
		    <h1 class="memory-title">Your Memory</h1>
		    <h2>Hello, <span id="name"><?php echo $name ?></span>!<br />Thanks for sharing your memory with me!</h2>

				<div id="sketch-holder">
					<!--
		      <canvas id="sketch-holder" class = "p5Canvas" width = "1200" height = "1200"
					style = "width 50%; height 50%">-->
		    </div>

		    <a href="choice.html">
		      <div class="svg-wrapper-light purple" style="border: solid 5px var(--cpurple); margin-top: 80px;">
		        <div class="button-text-light" style="top:12px; color:white">Continue</div>
		      </div>
		    </a>
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
