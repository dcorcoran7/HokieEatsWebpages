<?php
    $rID = 0;
    $err = false;

    if (isset($_POST["modify"])) {
        if(isset($_POST["rID"])) $rID = $_POST["rID"];
        
        if(!empty($rID)) {
          header("HTTP/1.1 307 Temprary Redirect");
          header("Location: 6Modification.php");
        } else{
          $err = true;
          
        }
      }

    if (isset($_POST["delete"])) {
        if(isset($_POST["rID"])) $rID = $_POST["rID"];
        
        if(!empty($rID)) {
            header("HTTP/1.1 307 Temprary Redirect");
            header("Location: 5DeleteSuccess.php");
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


<!doctype html>

<html>
    <head>
        <title>HTML Table</title>

        <style>
            body {
                background-color: maroon !important;
                font-family: Arial, Helvetica, sans-serif !important;
            }

            h1 {
                color: white !important;
                font-size: 45px;
            }

            table {
                border: 1px solid white !important;
            }

            .Name {
                background-color: peachpuff !important;
                font-size: 20px !important;
                color: black !important;
            }

            .Header {
                background-color: orange !important;
                color: black !important;
                text-align: center !important;
                font-weight: bold !important;
                font-size: 25px !important;
            }

            .Body {
                background-color: peachpuff !important;
                font-size: 20px !important;
                color: black !important;
            }

            div.records {
                position: fixed;
                left: 500px;
                top: 150px;
            }

            #button1 {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 25px;
                font-size: 15px;
                font-weight: bold;
            }

            #button2 {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 150px;
                font-size: 15px;
                font-weight: bold;
            }

            #button3 {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 275px;
                font-size: 15px;
                font-weight: bold;
            }

            #submit {
                height: 50px;
                width: 100px;
                position: fixed;
                left: 20px;
                font-size: 15px;
                font-weight: bold;
            }

            h2 {
                color: white !important;
                font-size: 40px;
                text-align: center;
            }

            h3 {
                color: white !important;
                font-size: 25px;
            }

            .errlabel {
                color: orange !important;
            }

            label {
                color: white !important;
                font-size: 25px;
            }

            input {
                height: 25px;
                font-size: 20px;
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
        <h1>Review Modification:</h1>

        <h3>Which review would you like to alter?</h2>

        <div class = "records">
            <h2>Driver Review Table</h2>
            <?php 
                //add a new employee record if emptype is new. otherwise, modify the existing employee record
                require_once("db.php");

                //send a query to the database
                $sql = "Select * from review Group By DriverID, ReviewID Order By ReviewID ASC";
                $result = $mydb->query($sql);
                
                //$result should be a resultset 
                echo "<table>";
                    echo "<thead>";
                        echo "<tr class = 'Header'>";
                            echo "<td>","Review ID","</td>";
                            echo "<td>","Driver ID","</td>";
                            echo "<td>","First Name","</td>";
                            echo "<td>","Last Name","</td>";
                            echo "<td>","Rating","</td>";
                            echo "<td>","Review","</td>";
                            echo "<td>","Date of Review","</td>";
                        echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                                echo "<td class = 'Body'>".$row["ReviewID"]."</td>";
                                echo "<td class = 'Name'>".$row["DriverID"]."</td>";
                                echo "<td class = 'Body'>".$row["firstname"]."</td>";
                                echo "<td class = 'Body'>".$row["lastname"]."</td>";
                                echo "<td class = 'Body'>".$row["Rating"]."</td>";
                                echo "<td class = 'Body'>".$row["ReviewText"]."</td>";
                                echo "<td class = 'Body'>".$row["DateofReview"]."</td>";
                            echo "</tr>";
                        }
                    echo "</tbody>";
                echo "</table>"; 
            ?>
        </div>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

            <label>Review ID:
                <input id = "review" name = "rID" type="number" min = "0" step = "1" value="<?php echo $rID; ?>">
                <br>
                <?php
                    if ($err && empty($rID)) {
                        echo "<label class = 'errlabel'> Error: Please enter a review ID.</label>";
                    }
                    
                ?>
            </label> 
            <br><br>

            <button id = "button1" class = "button" name = "home">Back to Home</button>
            <button id = "button2" class = "modify" name = "modify">Modify</button>
            <button id = "button3" class = "delete" name = "delete">Delete</button>
        </form>
    
    </body>
</html>
