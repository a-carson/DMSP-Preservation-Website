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
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/choice.css">

<?php
function displayGif()
{
echo '<img src="../img/gif/save-gif/childhood.gif" style="width: 300px;" />';
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
            <?php displayGif(); ?>
        </div>

        <div class="button-container">
          <a href = "memory_list.php">
            <div class="svg-wrapper-light cyan choice-button" style="border: solid 5px var(--ccyan);">
                <div class="button-text-light" style="top:5px; color:white">
                    Home</div>
            </div>
          <a>

            <div class="svg-wrapper-light choice-button" style="border: solid 5px var(--cpurple);">
                <div class="button-text-light" style="top:5px; color:white">
                    Back</div>
            </div>

        </div>

</body>

</html>
