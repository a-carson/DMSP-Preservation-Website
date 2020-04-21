<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>4</title>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://unpkg.com/tone"></script>
  <script type="text/javascript" src='javascript/ascii_sonification.js'> </script>
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- animate -->


    <?php

      $error = '';
      if (isset($_GET["submit"]))
        {

          if (empty($_GET["name"]))
          {
            $error = "Please enter a name. It doesn't have to be your real name!";
            echo '<br>';
            echo $error;
            echo '<br>';
            echo '<br>';
          }
          if (empty($_GET["category"]))
          {
            $error = "Please choose a category";
            echo $error;
            echo '<br>';
            echo '<br>';
          }
          if (empty($_GET["memory"]))
          {
            $error = "Please enter a memory. That's why you're here right?";
            echo $error;
          }
          else
          {
            create_elements();
            // test for hackers
            $name = test_for_hackers($_GET["name"]);
            $category = test_for_hackers($_GET["category"]);
            $memory = test_for_hackers($_GET["memory"]);

            // new entry
            $newEntry = array(
              "name" => $name,
              "category" => $category,
              "memory" => $memory,
            );
              // get json
              $memoriesJson = file_get_contents('json/memories.json');
              // Convert JSON string to Array
              $memoriesArray = json_decode($memoriesJson, true);

              // append new entry
              $memoriesArray[] = $newEntry;

              // encode and write to json
              $encodedArray = json_encode($memoriesArray);
              file_put_contents('json/memories.json', $encodedArray);

              $currentMemory = $newEntry["memory"];

          }
        }

        function test_for_hackers($data)
        {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

      //print_r($memoriesArray);


      function create_elements()
      {
        echo '<link rel="stylesheet" href="css/style.css">';


      }

    ?>

<body id="body3">

  <div>
	<div class="left_bar3">
	  <img src="img/button/heading2.png" style="height: 600px; margin-top: 100px; margin-left: 20px;" alt="" />
	 </div>
	  <div class="middle_4">
		  <img src="img/button/pink_square.png" style="height: 250px; margin-top: 130px;" alt="">
		  <img src="img/button/pink_square.png" style="height: 250px; margin-top: 130px; float: right;" alt="">
		  <img src="img/button/pink_square.png" style="height: 250px; margin-top: 30px;" alt="">
		  <img src="img/button/pink_square.png" style="height: 250px; margin-top: 30px; float: right;" alt="">
	  </div>
	 <div class="right_bar4">
	  <button class="button4" type="button"><a href="category.html"> <img src="img/button/close.png" style="width: 50px; background-color: transparent; margin-top: 50px; margin-left: 180px;" alt="" /></a>
	  </button>
		<button class="button4" type="button"><a href="choice.html"> <img src="img/button/blue_button_next.png" style="width: 250px; height: 100px; background-color: transparent; margin-top: 150px;" alt="" /></a>
	  </button>
	 </div>
  </div>


</body>

<script>
var js_data = '<?php echo json_encode($currentMemory); ?>'
var text = JSON.parse(js_data);
sonify(text);
</script>


</html>
