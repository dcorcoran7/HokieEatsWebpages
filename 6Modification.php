<?php 
  $newrating = 0; 
  $newreview = ""; 
  $rID = 0;
  $err = false;

  if(isset($_POST["rID"])) $rID = $_POST["rID"];

  if (isset($_POST["submit"])) {
    if(isset($_POST["reviewID"])) $rID = $_POST["reviewID"];
    if(isset($_POST["newreview"])) $newreview = $_POST["newreview"];
    if(isset($_POST["newrating"])) $newrating = $_POST["newrating"];
    
    if(!empty($newrating) && !empty($newreview)) {
      header("HTTP/1.1 307 Temprary Redirect");
      header("Location: 7ModifySuccess.php"); 
    } else{
      $err = true; 
      
    }
  }

  if (isset($_POST["cancel"])) {
    $err = false;
    header("HTTP/1.1 307 Temprary Redirect");
    header("Location: 1ReviewHome.php"); 

  }

?>


<!DOCTYPE html>

<html>
    <head>
        <title>
            Review Modification:
        </title>

        <style>
            body {background-color: maroon !important;
                font-family: Arial, Helvetica, sans-serif !important;
            }

            h1 {
                color: white !important;
                font-size: 50px;
            }

            label {
                color: white !important;
                font-size: 25px;
            }

            div.one {
                position: fixed;
                left: 5px;
            }

            div.two {
                position: fixed;
                left: 400px;
            }

            .errlabel {
                color: orange !important;
            }

            #button {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 150px;
                font-size: 15px;
                font-weight: bold;
            }

            #submit {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 20px;
                font-size: 15px;
                font-weight: bold !important;
            }

            input {
                height: 25px;
                font-size: 20px;
            }

            textarea {
                font-size: 20px;
            }

            strong {
                color: orange !important;
                font-size: 40px;
            }

            #rating {
                width: 50px;
            }

            #reviewID {
                width: 50px;
            }

            #rating {
                color: black;
            }

            #reviewID {
                color: black;
            }

            #review {
                color: black;
            }


        </style>

        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>

    <body>
        <?php require_once("common_header.php"); ?>
        <?php 
            require_once("db.php");

            $sql = "Select firstname, lastname, DateofReview from review where ReviewID=".$rID;
            $result = $mydb->query($sql);

            $row = mysqli_fetch_array($result);

            $firstname = $row["firstname"];
            $lastname = $row["lastname"];  
            $date = $row["DateofReview"];
        ?>
        
        <h1>Review Modification For:
            <strong><?php echo " " .$firstname. " " .$lastname. " on " .$date?></strong>
        </h1> 
 
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class = "one">
                
                <label>New Driver Rating:
                    <input id = "rating" name = "newrating" type="number" min = 0 max = 10 step = "0.5" value="<?php echo $newrating; ?>">
                    <br>
                    <?php 
                        if ($err && empty($newrating)) {
                            echo "<label class = 'errlabel'> Error: Please enter a rating.</label>";
                        }                        
                    ?>
                </label> 
                <br><br>

                <label>Review ID:
                    <input id = "reviewID" name = "rID" type="number" min = "0" step = "1" value="<?php echo $rID; ?>" readonly>
                </label> 
                <br><br>

                <input id = "submit" type="submit" name="submit" value="Submit"/>

                <button id = "button" name = "cancel">Cancel</button>
            </div>

            <div class = "two">
                <label>New Written Review:<br>
                    <textarea id = "review" name = "newreview" rows = "12"  cols = "25" maxlength = "100" placeholder = "100 Characters Or Less"></textarea>
                    <br>
                    <?php 
                        if ($err && empty($newreview)) {
                            echo "<label class = 'errlabel'> Error: Please write a review.</label>";
                        }
                        
                    ?>
                </label> 
                <br><br>
            </div>

        </form>

    </body>
</html>