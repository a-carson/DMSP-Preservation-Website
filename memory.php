<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>3</title>

</head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">

	<body id="body3">

    <?php
    // initialise strings
    $name = '';
    $category = '';
    $memory = '';
    $error = ' ';

    // get json
    $memoriesJson = file_get_contents('json/memories.json');
    $memoriesArray = json_decode($memoriesJson, true);

    // when form is submitted
    // if (isset($_GET["submit"]))
    //   {
    //     if (empty($_GET["name"]))
    //     {
    //       $error = "Please enter a name. It doesn't have to be your real name!";
    //     }
    //     else if (empty($_GET["category"]))
    //     {
    //       $error = "Please choose a category";
    //     }
    //     else if (empty($_GET["memory"]))
    //     {
    //       $error = "Please enter a memory. That's why you're here right?";
    //     }
    //     else
    //     {
    //       // test for hackers
    //       $name = test_for_hackers($_GET["name"]);
    //       $category = test_for_hackers($_GET["category"]);
    //       $memory = test_for_hackers($_GET["memory"]);
    //
    //       // new entry
    //       $newEntry = array(
    //         "name" => $name,
    //         "category" => $category,
    //         "memory" => $memory,
    //       );
    //
    //       // append new entry
    //       $memoriesArray[] = $newEntry;
    //
    //       // encode and write to json
    //       $encodedArray = json_encode($memoriesArray);
    //       file_put_contents('json/memories.json', $encodedArray);
    //
    //       //navigate to next page
    //       header("Location: start.php");
    //     }
    //   }
    //
    //   function test_for_hackers($data)
    //   {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    //   }

    ?>

		<div>
			<div class="left_bar3">
				<img src="img/button/heading2.png" style="height: 600px; margin-top: 100px; margin-left: 20px;" alt="" />
			</div>
			<div class="right_bar3">

				<br><br>

          <form action = "start.php" method="get">
            <div class="input_bar3_name">
                  Name: <input type="text" name="name" class="form-control3_name" id="name" placeholder="Name">
            </div>
            <div class="input_bar3_category">
                  Category: <input type="text" name="category" class="form-control3_category" id="category" placeholder="Category">
				    </div><br>
            <div class="input_bar3_content">
                  Memory:	<input type="text" name="memory" class="form-control3_2" id="memory" placeholder="Enter memory here..."><br>
            </div>
            <div class="button3_start">
              <button class="button3" type="submit" name = "submit">
               <img src="img/button/purple_button_start.png" style="width: 200px; background-color: transparent;" alt="" /></a>
          </form>

				</div>
			</div>
		</div>

	</body>


</html>
