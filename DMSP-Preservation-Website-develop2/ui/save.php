<!doctype html>
<html>

<head>
    <title>Choice-Childhood</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/choice.css">
</head>


<?php
session_start();

$save_gif_string = "../img/gif/save-gif/";
$save_gif_string. = $_SESSION["category"];
$save_gif_string. = ".gif";

$memoriesJson = file_get_contents('../json/memories.json');
$memoriesArray = json_decode($memoriesJson, true);

// ADD FORM DATA TO ARRAY
$newEntry = array(
  "name" => $_SESSION["name"],
  "category" => $_SESSION["category"],
  "memory" => $_SESSION["memory"],
);
$memoriesArray[] = $newEntry;

// WRITE TO JSON
$encodedArray = json_encode($memoriesArray);
file_put_contents('../json/memories.json', $encodedArray);
?>

<body id="body3">
    <div class="nav">
        <a href="memory_list.php">
            <img class="nav" src="../img/button/close.png" style="width: 2vw;" alt="" />
        </a>
    </div>
    <div class="row align-items-center justify-content-center choice-container">
        <div class="col-sm-12" style="text-align: center;">
            <img src="../img/heading/heading.png" class="center" style="width: 40vw;"
                alt="Memory Booth" />
        </div>

        <img src="../img/bg/modal1.png" class="frame" style="width: 60vw;" />

        <div class="gif-container center">
            <img id = "save-gif" src = '<?php echo $save_gif_string ?>' style="width: 20vw;" />
        </div>

        <div>
            <h1 class="center" style="top:40%">Save successful.</h1>
        </div>

        <div class="button-container">
            <a id = "memory-link" href = "view_memory.php">
              <div class="svg-wrapper-light cyan choice-button" style="border: solid 0.5vw var(--ccyan);">
                  <div class="button-text-light" style="top:0.2vw; color:white">
                      View Memory</div>
              </div>
            <a>

            <a id = "home-link" href = "memory_list.php">
              <div class="svg-wrapper-light choice-button" style="border: solid 0.5vw var(--cpurple);">
                  <div class="button-text-light" style="top:0.2vw; color:white">
                      Home</div>
              </div>
            <a>

        </div>

</body>

</html>
