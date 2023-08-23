<!doctype html>

<html>
  <head>
    <title>Review Creation Success Page</title>

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
      $dID = "";
      $rating = 0; 
      $date = "";
      $review = "";
    
      if(isset($_POST["dFirstName"])) $dID = $_POST["dFirstName"];
      if(isset($_POST["rating"])) $rating = $_POST["rating"];
      if(isset($_POST["date"])) $date = $_POST["date"];
      if(isset($_POST["review"])) $review = $_POST["review"];

    ?>

    <?php
      //add a new review to the database
      require_once("db.php");
      
      $sql = "select * from user where userID='$dID'";
      $result = $mydb->query($sql);
      $row=mysqli_fetch_array($result);
      $dFirstName = $row["firstname"];
      $dLastName = $row["lastname"];

      $sql = "insert into review(DriverID, UserID, firstname, lastname, rating, ReviewText, DateofReview) values('$dID', '$dID', '$dFirstName', '$dLastName', '$rating', '$review', '$date')";

      $result=$mydb->query($sql);

      if ($result == 1) {
        echo "<p>A new review has been created</p>";
      }
      
    ?>

    <a href="1ReviewHome.php" id = "home">Return Home</a>
    
  </body>
</html>
