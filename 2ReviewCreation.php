<?php 
  $dFirstName = "";
  $rating = 0; 
  $date = "";
  $review = "";
  $err = false;

  if (isset($_POST["submit"])) {
    if(isset($_POST["dFirstName"])) $dFirstName = $_POST["dFirstName"];
    if(isset($_POST["rating"])) $rating = $_POST["rating"];
    if(isset($_POST["date"])) $date = $_POST["date"];
    if(isset($_POST["review"])) $review = $_POST["review"];
    
    if(!empty($dFirstName) && !empty($rating) && !empty($date) && !empty($review)) {
      header("HTTP/1.1 307 Temprary Redirect");
      header("Location: 3ReviewCreationSuccess.php");
    } else{
      $err = true; 
    }
  }

  if (isset($_POST["home"])) {
    $err = false;
    header("HTTP/1.1 307 Temprary Redirect");
    header("Location: 1ReviewHome.php"); 

  }

?>


<!DOCTYPE html>

<html>
    <head>
        <title>
            Review Creation:
        </title>

        <style>
            body {background-color: maroon !important;
                font-family: Arial, Helvetica, sans-serif!important;
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
                left: 500px;
            }

            .errlabel {
                color: orange !important;
            }

            #button {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 150px;
                font-size: 15px !important;
                font-weight: bold !important;
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

            #dFirstName {
                height: 25px;
                font-size: 20px;
                color: black;
            }

            #rating {
                color: black;
            }

            #date {
                color: black;
            }

            #textArea {
                color: black;
            }

            textarea {
                font-size: 20px!important;
            }

        </style>

        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>

    <body>
        <?php require_once("common_header.php"); ?>
        <h1>Review Creation:</h1> 
 
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class = "one">
                <label> Driver First Name
                    <select  id = "dFirstName" name = "dFirstName"> 
                        <?php 
                            require_once("db.php"); 
                            $sql = "SELECT firstname, lastname, userID FROM user Where isUser = '0' Order By firstname";
                            $result = $mydb->query($sql);

                            while($row = mysqli_fetch_array($result)){ ?>
                                <option value="<?php echo $row['userID']; ?>" <?php if($dFirstName == $row['userID']) echo "selected"; ?>> <?php echo $row['firstname'] . " " .$row['lastname']; ?> </option>;
                            <?php } 
                            
                        ?>
                    </select>
                </label>
                <br><br>

                <label>Driver Rating:
                    <input id = "rating" name = "rating" type="number" min = 0 max = 10 step = "0.5" value="<?php echo $rating; ?>">
                    <br>
                    <?php 
                        if ($err && empty($rating)) {
                            echo "<label class = 'errlabel'> Error: Please enter a rating.</label>";
                        }                        
                    ?>
                </label> 
                <br><br>

                <label>Date:
                    <input  id = "date" name = "date" type="date" value="<?php echo $date; ?>">
                    <br>
                    <?php 
                        if ($err && empty($date)) {
                            echo "<label class = 'errlabel'> Error: Please enter a date.</label>";
                        }
                    ?>
                </label> 
                <br><br>

                <input id = "submit" type="submit" name="submit" value="Submit"/>

                <button id = "button" name = "home">Back to Home</button>
            </div>

            <div class = "two">
                <label>Written Review:<br>
                    <textarea id = "textArea" name = "review" rows = "12"  cols = "25" maxlength = "100" placeholder = "100 Characters Or Less"></textarea>
                    <br>
                    <?php 
                        if ($err && empty($review)) {
                            echo "<label class = 'errlabel'> Error: Please write a review.</label>";
                        }
                        
                    ?>
                </label> 
                <br><br>
            </div>

        </form>

    </body>
</html>