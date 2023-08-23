<?php
    $dID = 0;
    $err = false;

    if (isset($_POST["submit"])) { 
        if(isset($_POST["dID"])) $dID = $_POST["dID"];
        
        if(!empty($dID)) { 
          header("HTTP/1.1 307 Temprary Redirect");
          header("Location: 9ReviewAnalyticsSuccess.php");
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
            body{
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

            div.records {
                position: fixed;
                left: 675px;
                top: 160px;
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

            #id {
                color: black;
            }


            .bar {
                fill: white;
            }

            .bar:hover {
                fill: orange;
            }

            .axis--x path {
                display: none;
            }

            .graph {
                position: fixed;
                top: 400px;
                left: 5px;
            }


        </style>

        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php require_once("common_header.php"); ?>
        <h1>Review Analytics:</h1>

        <h3>Which driver would you like to look up reviews for?</h2>

        <div class = "records"> 
            <h2>Driver Review Table</h2>
            <?php 
                //add a new employee record if emptype is new. otherwise, modify the existing employee record
                require_once("db.php");

                //send a query to the database
                $sql = "Select Distinct DriverID, firstname, lastname from review Group By DriverId, ReviewID Order By DriverID ASC";
                $result = $mydb->query($sql);
                
                //$result should be a resultset 
                echo "<table>";
                    echo "<thead>";
                        echo "<tr class = 'Header'>";
                            echo "<td>","Driver ID","</td>";
                            echo "<td>","First Name","</td>";
                            echo "<td>","Last Name","</td>";
                        echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                                echo "<td class = 'Name'>".$row["DriverID"]."</td>";
                                echo "<td class = 'Body'>".$row["firstname"]."</td>";
                                echo "<td class = 'Body'>".$row["lastname"]."</td>";
                            echo "</tr>";
                        }
                    echo "</tbody>";
                echo "</table>"; 
            ?>
        </div>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

            <label>Driver ID:
                <input id = "id" name = "dID" type="number" min = "0" step = "1" value="<?php echo $dID; ?>">
                <br>
                <?php
                    if ($err && empty($dID)) {
                        echo "<label class = 'errlabel'> Error: Please enter a driver ID.</label>";
                    }
                    
                ?>
            </label> 
            <br><br>

            <input id = "submit" type="submit" name="submit" value="Submit"/>
            <button id = "button" class = "button" name = "home">Back to Home</button>
        </form>

        <div class = "graph">
            <h3 id = "title">Average Rating:</h3>
            <svg width="500" height="300"></svg>

            <script src="https://d3js.org/d3.v4.min.js"></script>
            <script>

                var svg = d3.select("svg"),
                    margin = {top: 20, right: 20, bottom: 30, left: 40},
                    width = +svg.attr("width") - margin.left - margin.right,
                    height = +svg.attr("height") - margin.top - margin.bottom;

                var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
                    y = d3.scaleLinear().rangeRound([height, 0]);

                var g = svg.append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                d3.json("getData.php", function(error,data) {
                    if(error) throw error;
                    data.forEach(function(d) {
                        d.letter = d.name;
                        d.frequency = +d.Rating;
                    })


                if (error) throw error;

                x.domain(data.map(function(d) { return d.letter; }));
                y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

                g.append("g")
                    .attr("class", "axis axis--x")
                    .attr("transform", "translate(0," + height + ")")
                    .call(d3.axisBottom(x));

                g.append("g")
                    .attr("class", "axis axis--y")
                    .call(d3.axisLeft(y).ticks(4, "s"))
                    .append("text")
                    .attr("transform", "rotate(-90)")
                    .attr("y", 6)
                    .attr("dy", "0.71em")
                    .attr("text-anchor", "end")
                    .text("Frequency");

                g.selectAll(".bar")
                    .data(data)
                    .enter().append("rect")
                    .attr("class", "bar")
                    .attr("x", function(d) { return x(d.letter); })
                    .attr("y", function(d) { return y(d.frequency); })
                    .attr("width", x.bandwidth())
                    .attr("height", function(d) { return height - y(d.frequency); });
                });
            </script>

        </div>      
        
    
    </body>
</html>
