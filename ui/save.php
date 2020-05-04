<!doctype html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T40QBMYD00"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T40QBMYD00');
</script>

    <meta charset="UTF-8">
    <title>Choice-Childhood</title>
    <link rel="icon" href="../img/tab-icon.png">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/choice.css">

<?php
session_start();

$save_gif_string = "../img/gif/save-gif/";
$save_gif_string.= $_SESSION["category"];
$save_gif_string.= ".gif";

// GET MEMORY JSON
$memoriesJson = file_get_contents('../json/memories.json');
$memoriesArray = json_decode($memoriesJson, true);

// ADD FORM DATA TO ARRAY
$newEntry = array(
  "name" => $_SESSION["name"],
  "category" => $_SESSION["category"],
  "memory" => $_SESSION["memory"],
  "h" => $_SESSION["h"],
  "s" => $_SESSION["s"],
  "b" => $_SESSION["b"],
);
$memoriesArray[] = $newEntry;

// WRITE TO JSON
$encodedArray = json_encode($memoriesArray);
file_put_contents('../json/memories.json', $encodedArray);

?>

<body id="body3">
<div class="question-container">
  <img src="../img/bg/modal1.png" class="frame" style="width: 800px;" />
  <a href="memory_list.php">
    <img src="../img/heading/heading.png" class="center heading" alt="Memory Booth" />
  </a>
  <div class="row align-items-center justify-content-center choice-container">
    <div class="col-md-12 my-auto" style="text-align: center; ">
      <img id = "save-gif" src = '<?php echo $save_gif_string ?>' style="position: relative;top: 5vw;width: 400px;" />

      <div class="button-container">
        <a href="view_memory.php" style="text-decoration: none;">
          <div class="svg-wrapper-light cyan choice-button-wide" style=" border: solid 5px var(--ccyan)"
            onclick="window.location.href = 'animation.html'">
            <span><div class="button-text-light" style="top:2px; color:white" id="save">
              View Memory</div></span>

          </div>
        </a>
        <a href="memory_list.php" style="text-decoration: none;">
          <div class="svg-wrapper-light choice-button-wide" style="border: solid 5px var(--cpurple);">
            <div class="button-text-light" style="top:2px; color:var(--main-color)" id="dont-save">
              Home</div>
          </div>
        </a>
      </div>

    </div>
  </div>
</div>
<body>
</html>
