<!DOCTYPE html>
<html>
<body>

  <?php
    // JSON string
    $some_json = file_get_contents('json/memories.json');
    // Convert JSON string to Array
    $someArray = json_decode($some_json, true);
    print_r($someArray);        // Dump all data of the Array
    echo $someArray[0]["name"]; // Access Array data

    // Convert JSON string to Object
    //$someObject = json_decode($someJSON);
    //print_r($someObject);      // Dump all data of the Object
    //echo $someObject[0]->name; // Access Object data
  ?>

</body>
</html>
