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
        $reviewID = ""; 
        $newrating = 0; 
        $newreview = "";
    
        if(isset($_POST["rID"])) $reviewID = $_POST["rID"];
        if(isset($_POST["newreview"])) $newreview = $_POST["newreview"];
        if(isset($_POST["newrating"])) $newrating = $_POST["newrating"];

    ?>

    <?php
        //update and existing review
        require_once("db.php");

        $sql = "Update review set Rating='" .$newrating. "', ReviewText='" .$newreview. "' where ReviewID = '" .$reviewID. "'";
        $result=$mydb->query($sql);

        if ($result==1) {
            echo "<p>A review record has been updated</p>";
        }
      
    ?>

    <a href="1ReviewHome.php" id = "home">Return Home</a>
    
  </body>
</html>