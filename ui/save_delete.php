<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Choice-Childhood</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/choice.css">

<?php
session_start();
$name = $_SESSION["name"];
$category = $_SESSION["category"];
$memory = $_SESSION["memory"];

// GIF PATHS
$save_gif_string = "../img/gif/save-gif/";
$save_gif_string.= $category;
$save_gif_string.= ".gif";
$delete_gif_string = "../img/gif/delete-gif/";
$delete_gif_string.= $category;
$delete_gif_string.= "-delete.gif";

$message = '';
if (isset($_POST["submit"]))
{

    $memoriesJson = file_get_contents('../../json/memories.json');
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
    file_put_contents('../../json/memories.json', $encodedArray);
    $message = 'Save successful';


}
function playSaveGif()
{
  if (isset($_POST["submit"]))
  {
    $save_gif_string = "../img/gif/save-gif/";
    $save_gif_string.= $_SESSION["category"];
    $save_gif_string.= ".gif";
    //echo "play gif";
    echo "<img id = 'save-gif' src =";
    echo  $save_gif_string;
    echo "style='width: 400px;' />";
  }
}


 ?>

<body id="body3">
    <div class="nav">
        <a href="memory_list.php">
            <img class="nav" src="../img/button/close.png" style="width: 30px;" alt="" />
        </a>
    </div>
    <div class="row align-items-center justify-content-center choice-container">
        <div class="col-sm-12" style="text-align: center;">
            <img src="../img/heading/heading.png" class="center" style="width: 600px; padding-top:100px"
                alt="Memory Booth" />
        </div>
        <img src="../img/bg/modal1.png" class="frame" style="width: 800px;" />

        <div class="gif-container center">
            <?php playSaveGif() ?>
            <!--<img id = "save-gif" src = '<?php echo $save_gif_string ?>' style="width: 400px;" />
            <img id = "delete-gif" src = '<?php echo $delete_gif_string ?>' style="width: 400px;" />
            <h1 id = "save-memory-text" class="center" style="top:40%">Would you like me to preserve your memory, <?php echo $name;?>?</h1>-->
        </div>

        <form  action = "" method = "post">
        <div class="button-container">
          <button type = submit name = "submit" id = "save-button" class="svg-wrapper-light cyan choice-button" style="border: solid 5px var(--ccyan);">
                <div class="button-text-light" style="top:0px; color:white">
                    Save</div>
          </button>
        </form>

            <button id = "delete-button" onclick = "playDeleteGif()" class="svg-wrapper-light choice-button" style="border: solid 5px var(--cpurple);">
                <div class="button-text-light" style="top:0px; color:white">
                    Delete</div>
            </button>

            <a id = "memory-link" href = "memory_list.php">
              <div class="svg-wrapper-light cyan choice-button" style="border: solid 5px var(--ccyan);">
                  <div class="button-text-light" style="top:5px; color:white">
                      View Memory</div>
              </div>
            <a>

            <a id = "home-link" href = "memory_list.php">
              <div class="svg-wrapper-light choice-button" style="border: solid 5px var(--cpurple);">
                  <div class="button-text-light" style="top:5px; color:white">
                      Home</div>
              </div>
            <a>

        </div>
</body>

<script>
document.getElementById("memory-link").style.display = "none";
document.getElementById("home-link").style.display = "none";
document.getElementById("save-gif").style.display = "none";
document.getElementById("delete-gif").style.display = "none";

function playSaveGif()
{
document.getElementById("save-gif").style.display = "block";
changeDisplay();
}

function playDeleteGif()
{
document.getElementById("delete-gif").style.display = "block";
changeDisplay();
}

function changeDisplay()
{
  document.getElementById("save-button").style.display = "none";
  document.getElementById("delete-button").style.display = "none";
  document.getElementById("save-memory-text").style.display = "none";
  document.getElementById("home-link").style.display = "block";
  document.getElementById("memory-link").style.display = "block";
}


</script>
</html>
