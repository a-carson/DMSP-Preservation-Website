<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Category</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="stylesheet" href="../css/memoryList.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron" rel="stylesheet">
<link rel="stylesheet"
    href="https://blogfonts.com/css/aWQ9NDg4ODAmc3ViPTg4MCZjPWImdHRmPUJyeW5kYTEyMzErU2Fucy50dGYmbj1icnluZGExMjMxLXNhbnM/Brynda1231 Sans.ttf" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js'></script>

<?php

function createElements($category)
{
  $memoriesJson = file_get_contents('../../json/memories.json');
  $memoriesArray = json_decode($memoriesJson, true);
  $array_length = count($memoriesArray);

  if ($category == "childhood")
  {
    $class = '"button-memory pink"';
    $img = '"../img/cd/CD-childhood.png"';
  }
  if ($category == "travel")
  {
    $class = '"button-memory yellow"';
    $img = '"../img/cd/CD-travel.png"';
  }
  if ($category == "student-life")
  {
    $class = '"button-memory blue"';
    $img = '"../img/cd/CD-study.png"';
  }
  if ($category == "others")
  {
    $class = '"button-memory green"';
    $img = '"../img/cd/CD-other.png"';
  }

  for ($i = 0; $i < $array_length; $i++)
  {
    if ($memoriesArray[$i]["category"] == $category)
    {
      echo '<button type = "submit"';
      echo '        name ="submit_'; echo $i; echo '"';
      echo '        class='; echo $class;
      echo '        id='; echo $category; echo'>';
      echo '      <img src='; echo $img;
      echo '              style="width: 150px; background-color: transparent; margin:10px;" alt="" />
                <div class="CD-description">
                    <span id="id">';
                    echo '#0'; echo $i+1;
      echo '        </span>
                    <span id="name">';
                    echo $memoriesArray[$i]["name"];
      echo '        </span>
                    <h2 id="content" class="content">';
                    echo $memoriesArray[$i]["memory"];
      echo '        </h2>
                </div>
            </button>
            ';
    }
  }
}

?>

<body class="memory-list">

    <div class="gradient-bg">
    </div>

    <div class="hamburger">
        <button class="button-hamburger" type="button"><a href="menu.html"> <img src="../img/button/narv.png"
                    style="width: 50px; background-color: transparent; " alt="" /></a>
        </button>
    </div>

    <div class="container" id="tablist-section">
        <nav class="row">
            <div class="nav col-12 justify-content-center" id="nav-tab" role="tablist" style="margin: 20px 0;">

                <a class="nav-item nav-link active" id="nav-childhood-tab" data-toggle="tab" href="#nav-childhood"
                    role="tab" aria-controls="nav-childhood" aria-selected="true">
                    <div class="svg-wrapper-light pink" style="width:200px;">
                        <svg style=" height:60px; width: 200px;" xmlns="http://www.w3.org/2000/svg">
                            <rect class="shape-light pink" style="height:60px; width:200px;" stroke="#ffffff90" />
                        </svg>
                        <div class="button-text-light">Childhood</div>
                    </div>
                </a>

                <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab"
                    aria-controls="nav-travel" aria-selected="false">
                    <div class="svg-wrapper-light yellow" style="width:200px; margin-right: 40px;">
                        <svg style=" height:60px; width: 200px;" xmlns="http://www.w3.org/2000/svg">
                            <rect class="shape-light yellow" style="height:60px; width:200px;" stroke="#ffffff90" />
                        </svg>
                        <div class="button-text-light">Travel</div>
                    </div>
                </a>

                <a class="nav-item nav-link" id="nav-sl-tab" data-toggle="tab" href="#nav-sl" role="tab"
                    aria-controls="nav-sl" aria-selected="false">
                    <div class="svg-wrapper-light blue" style="width:200px;">
                        <svg style=" height:60px; width: 200px;" xmlns="http://www.w3.org/2000/svg">
                            <rect class="shape-light blue" style="height:60px; width:200px;" stroke="#ffffff90" />
                        </svg>
                        <div class="button-text-light">Student Life</div>
                    </div>
                </a>

                <a class="nav-item nav-link" id="nav-others-tab" data-toggle="tab" href="#nav-others" role="tab"
                    aria-controls="nav-others" aria-selected="false">
                    <div class="svg-wrapper-light cyan" style="width:200px;">
                        <svg style=" height:60px; width: 200px;" xmlns="http://www.w3.org/2000/svg">
                            <rect class="shape-light green" style="height:60px; width:200px;" stroke="#ffffff90" />
                        </svg>
                        <div class="button-text-light">Others</div>
                    </div>
                </a>
            </div>
        </nav>
        <div class="tab-content row scroll" id="nav-tabContent"
            style="max-height:70vh; overflow-y: auto; overflow-x: hidden;">

            <!-- CHILDHOOD -->
            <div class="tab-pane fade show active col-12 col-md-10  offset-md-1 " id="nav-childhood" role="tabpanel"
                aria-labelledby="nav-childhood-tab">
                <div class="row">
                    <div class="col-12 align-self-center" style="margin-left:20px">
                    <form action = "view_memory.php" method="get">
                      <?php createElements("childhood") ?>
                    </div>
                </div>
            </div>
            <!-- TRAVEL -->
            <div class="tab-pane fade col-12 col-md-10 offset-md-1" id="nav-travel" role="tabpanel"
                aria-labelledby="nav-travel-tab">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <?php createElements("travel") ?>
                    </div>
                </div>
            </div>

            <!-- STUDENT LIFE -->
            <div class="tab-pane fade col-12 col-md-10 offset-md-1" id="nav-sl" role="tabpanel"
                aria-labelledby="nav-sl-tab">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <?php createElements("student-life") ?>
                    </div>
                </div>
            </div>

            <!-- OTHER -->
            <div class="tab-pane fade col-12 col-md-10 offset-md-1" id="nav-others" role="tabpanel"
                aria-labelledby="nav-others-tab">
                <div class="row">
                    <div class="col-12 align-self-center">
                      <?php createElements("others") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="fixed-bottom">
        <a href="record_memory.html">
            <div class="center" style="width:500px">
                <div class="col-12 align-self-center" style="margin:50px 0 0 0">
                    <div class="svg-wrapper-light purple" style="width:100%; border: solid 5px var(--cpurple);">
                        <div class="button-text-light" style="top:5px; color:white">Add My
                            Memories</div>
                    </div>
                </div>
            </div>
        </a>
    </div>

</body>

</html>
