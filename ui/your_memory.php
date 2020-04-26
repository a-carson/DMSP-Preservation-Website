<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Your Memory - Memory Booth</title>
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
		session_start();

		// GET JSON
		$memoriesJson = file_get_contents('../../json/memories.json');
		$memoriesArray = json_decode($memoriesJson, true);

		// GET FORM DATA
    $name = test_for_hackers($_POST["name"]);
    $category = test_for_hackers($_POST["category"]);
    $memory = test_for_hackers($_POST["memory"]);
		$memory.= " ";

		// UPDATE SESSION
		$_SESSION["name"] = $name;
		$_SESSION["category"] = $category;
		$_SESSION["memory"] = $memory;
		$_SESSION["index"] = count($memoriesArray);

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

		// ADD TO SESSION
		$_SESSION["h"] = $h;
		$_SESSION["s"] = $s;
		$_SESSION["b"] = $b;

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

				<div style="text-align: center;">
					<h1 class="memory-title" style="margin: 40px">Your Memory</h1>
					<h2>Hello, <span id="name"><?php echo $name ?></span>!<br />Thanks for sharing your memory with me! <br> <span id = "encoding">Now encoding...</span></h2>

					<p id = "letters" style="color:white; margin-top: 5px;">.</p>

				<div id="sketch-holder"> </div>

		    <a href="choice.html">
		      <div class="svg-wrapper-light purple" style="border: solid 5px var(--cpurple); margin-top: 80px;">
		        <div id = "button-text" class="button-text-light" style="top:12px; color:white">Encoding...</div>
		      </div>
				</a>

		  </div>

		</body>

<script>
var memory_data = '<?php echo json_encode($memory); ?>'
var text = JSON.parse(memory_data);
setInputText(text);
setColours();
play();

function setColours()
{
	h = JSON.parse('<?php echo json_encode($h); ?>');
	s = JSON.parse('<?php echo json_encode($s); ?>');
	b = JSON.parse('<?php echo json_encode($b); ?>');
	for (var i = 0; i < 8; i++)
	{
		strokes[i] = 3 - 0.3*i;
	}
}
</script>


</html>
