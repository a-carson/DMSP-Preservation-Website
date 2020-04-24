<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Choice</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- animate -->

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/choice.css">

<?php
session_start();
?>
<body id="body3">
	<div>
		<div class="nav">
			<a href="menu.html">
				<img class="nav" src="../img/button/close.png" style="width: 30px;" alt="" />
			</a>
		</div>
		<div class="row align-items-center justify-content-center choice-container">
			<div class="col-sm-12" style="text-align: center;">
				<img src="../img/bg/modal1.png" class="frame" style="width: 800px;" />
				<img src="../img/heading/heading.png" class="center" style="width: 600px;top:15%" alt="Memory Booth" />

				<h1 id = "text" class="center" style="top:40%">Would you like me to preserve your memory?</h1>
				
				<div class="button-container" style="padding:400px 0 0 0">
					<a href="choice_childhood.html">
						<div class="svg-wrapper-light choice-button-wide" style="border: solid 5px var(--cpurple);">
							<div class="button-text-light" style="top:5px; color:white">
								YES</div>
						</div>
					</a>

					<a href="delete.html">
						<div class="svg-wrapper-light cyan choice-button-wide" style="border: solid 5px var(--ccyan);">
							<div class="button-text-light" style="top:5px; color:white">
								NO</div>
						</div>
					</a>

					<!--
					<a href="choice_childhood.html">
						<div class="svg-wrapper-light cyan choice-button-narrow"
							style="border: solid 5px var(--ccyan);">
							<div class="button-text-light" style="top:5px; color:white">
								Save</div>
						</div>
					</a>
				-->
				<!--
		<div class="right_bar3">
			<div class="problem_5">
				<h1>Save your memory?</h1>

			</div>
			<div class="button5">
				<div class="box5">
					<button class="button5" type="button"><a href="yes.html"> <img src="img/button/yes.png"
								style="width: 230px; background-color: transparent;" alt="" /></a>
					</button>
				</div>
				<div class="box5_2">
					<button class="button5" type="button"><a href="category.html"> <img src="img/button/delete.png"
								style="width: 230px; background-color: transparent; float: right;" alt="" /></a>
					</button>
				</div>
			</div>
		</div>
		-->

			</div>
</body>

</html>
