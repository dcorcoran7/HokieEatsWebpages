<!doctype html>

<html>
  <head>
    <title>Review Deletion Success Page</title>

    <style> 
      body {
        background-color: maroon !important;
        font-family: Arial, Helvetica, sans-serif !important;
        }

      #home {
        color: white !important;
        }

      a:hover {
        font-style: italic !important;
      }

      p {
        color: white !important;
        font-size: 25px;
      }

    </style>

    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </head>

  <body>
    <?php
      $rID = ""; 
    
      if(isset($_POST["rID"])) $rID = $_POST["rID"];

    ?>

    <?php
      //add a new review to the database
      require_once("db.php");

      $sql = "Delete from review where ReviewID = ".$rID;

      $result=$mydb->query($sql);

      if ($result == 1) {
        echo "<p>The selected review has been successfully been deleted</p>";
      }
      
    ?>

    <a href="1ReviewHome.php" id = "home">Return Home</a>
    
  </body>
</html>