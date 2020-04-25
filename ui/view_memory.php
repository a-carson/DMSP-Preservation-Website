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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://unpkg.com/tone"></script>
<script type="text/javascript" src="../js/sound_and_vision.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Orbitron" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="../css/style.css">
<!--
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style_old.css">
-->
<?php
session_start();
$index = $_SESSION["index"];
session_destroy();

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


	<div class="center" style="width:100%">
		<div class="row">
			<div class="col-md-5">
				<div id="sketch-holder">
				</div>
			</div>
			<div class="col-md-7 my-auto" style="text-align: left;">
				<span class="view-memory" id="id">#0<?php echo $index + 1;?> </span>
				<span class="view-memory" id="name"><?php echo $name ;?></span>
				<div class="view-content scroll" id="content">
					<p class="distort">
						<?php echo $memory?>
					</p>
				</div>

				<h3 style="display: inline-block;">Category:</h3>
				<span class="view-memory" id="category"><?php echo $category ?></span>
			</div>
		</div>
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

  "use strict";
	//ONLOAD
	$(function () {
		//DECLARE GLOBAL VARIABLE FOR USE IN HANDLERS
		var orig, sib;
		var runs = 0;
		var charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890+>?-$#@%&*'; //RUN JS WHEN 'DISTORT' IS HOVERED

		$('.distort').hover(function () {
			var curr = $(this);
			orig = $(this).text();
			sib = setInterval(function () {
				distortText(curr);
			}, 100);
		}, function () {
			//RESET THE ORIGINAL TEXT
			clearInterval(sib);
			$(this).text(orig);
		});

		function distortText(i) {
			//MAINTAINS SOME READABILITY IN THE TEXT BY ONLY ALLOWING 3 CHARACTERS TO BE DISTORTED
			if (runs >= 2) {
				runs = 0;
				i.text(orig);
				return;
			} //GET EACH INDIVIDUAL CHARACTER


			var chars = i.text().split(''); //GET A RANDOM CHARACTER FROM THE TEXT
			var rand = Math.floor(Math.random() * chars.length); //GET A RANDOM REPLACEMENT CHARACTER
			var randRep = Math.floor(Math.random() * charSet.length); //CHECK TO MAKE SURE THAT THE NEW CHARACTER IS DIFFERENT FROM THE OLD

			if (chars[rand] != charSet[randRep] && chars[rand] != ' ') {
				chars[rand] = charSet[randRep];
			} else {
				distortText(i);
			} //UPDATE TEXT


			i.text(chars.join(''));
			runs += 1;
		}
	});

</script>


</html>
