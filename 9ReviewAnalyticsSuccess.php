<?php
    $dID = 0;

    if(isset($_POST["dID"])) $dID = $_POST["dID"];

    if (isset($_POST["analysisHome"])) {
        header("HTTP/1.1 307 Temprary Redirect");
        header("Location: 8ReviewAnalysis.php"); 
    
    }
?>
 
<!doctype html>

<html>
  <head>
    <title>
        Review Analtyics Success Page
    </title> 

    <style>
        body {
            background-color: maroon !important;
            font-family: Arial, Helvetica, sans-serif !important;
        }

        table {
                border: 1px solid white !important;
            }

        .Name {
            background-color: peachpuff !important;
            font-size: 20px;
            color: black !important;
        }

        .Header {
            background-color: orange !important;
            color: black !important;
            text-align: center;
            font-weight: bold;
            font-size: 25px;
        }

        .Body {
            background-color: peachpuff !important;
            font-size: 20px;
            color: black !important;
        }

        h2 {
            color: white !important;
            font-size: 40px;
            text-align: center !important;
        }

        #button {
            height: 80px;
            width: 200px;
            position: fixed;
            left: 100px;
            font-size: 20px;
            font-weight: bold;
        }

        div.records {
            position: fixed;
            left: 675px;
            top: 160px;
        }

        h1 {
            color: white !important;
            font-size: 45px;
        }

        h3 {
            color: white !important;
            font-size: 20px;
            width: 550px;
            left: 5px;
        }

        strong {
            color: orange !important;
        }

        .avgRating {
            position: fixed;
            left: 5px;
            top: 300px;
            color: white !important;
            font-size: 20px;
        }

        .image {
            position: fixed;
            left: 50px;
            top: 450px;
        }

    </style>

        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    <script>
        function imageOver() {
            document.images[0].src="Burruss.jpg";
        }

        function imageOut(){
            document.images[0].src="VTLogo.png";
        }

        function init(){
            document.images[0].addEventListener("mouseover", imageOver, false);
            document.images[0].addEventListener("mouseout", imageOut, false);
        }

        window.addEventListener("load", init, false);
    </script>

  </head>

  <body>
    <?php require_once("common_header.php"); ?>
    <h1>Individual Driver Analytics:</h1> 

    <?php
        require_once("db.php");
 
        $sql = "Select firstname, lastname from review where DriverID=".$dID;
        $result = $mydb->query($sql);

        $row = mysqli_fetch_array($result);

        $firstname = $row["firstname"];
        $lastname = $row["lastname"];  
    ?>

    <h3>The following table holds all individual reviews for: 
        <strong><?php echo " " .$firstname. " " .$lastname?></strong>
    </h3>

    <?php
        require_once("db.php");

        $sql = "Select AVG(Rating) as AvgRating from review where DriverID=".$dID;
        $result = $mydb->query($sql);

        $row = mysqli_fetch_array($result);

        $avgRating = $row["AvgRating"];
 
    ?>

    <h4 class = "avgRating">
        Average Rating: <?php echo $avgRating ?>
    </h4>

    <div class = "records">
        <h2>Driver Review Table</h2>
        <?php
            require_once("db.php");

            //send a query to the database
            $sql = "Select * from review Where DriverID = " .$dID. " Order By ReviewID";
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
    <br><br>

    <div class = "image">
        <img id = "image" src="VTLogo.png">
    </div>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <button id = "button" class = "button" name = "analysisHome">Back to Review Analysis Home</button>
    </form>
    <br><br>

  </body>
</html>