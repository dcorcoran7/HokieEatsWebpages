<!DOCTYPE html>

<html>
    <head>
        <title>
            Review Management Home Page
        </title>

        <style>
             body {background-color: maroon !important;
                font-family: Arial, Helvetica, sans-serif !important;
             }

             h1 {
                position: relative;
                color: white !important;
                font-size: 45px !important;
            }

            #homeButton {
                position: fixed;
                left: 675px;
                top: 275px;
                height: 50px;
                width: 100px;
                font-size: 15px;
                font-weight: bold !important;
            }

            h3 {
                position: relative;
                color: white !important;
                text-align: center; 
            }

            h3.button {
                position: relative;
                color: white !important;
                text-align: center;
                font-size: 25px;
            }

            div.text {
                position: fixed;
                width: 600px;
                top: 250px;
            }

            img {
                border: 5px !important;
                border-style: solid !important;
                border-color: black !important;
            }

            div.img1 {
                position: fixed;
                top: 360px;
                left: 5px;
            }

            div.img2 {
                position: fixed;
                top: 360px;
                left: 300px;
            }

            div.img3 {
                position: fixed;
                top: 360px;
                left: 595px;
            }

        </style>

        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <script src="jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>

    <body>
        <?php require_once("common_header.php"); ?>

        <h1>Review Management Home:</h1>

        <button id = "homeButton" onclick = "location.href='???????????????????????'">Back to Home</button>

        <div class = "text">
            <h3>Welcome to the Review Management Home Page! Here you can create, delete, 
                or modify reviews on a selected individual in our database.</h3>
        </div>

        <div class = "img1">
            <button onclick = "location.href='2ReviewCreation.php'">
                <img src="NewAdd.png" alt="Create Review">
            </button> 
            <h3 class = "button">Create Review</h3>                
        </div>
        
        <div class = "img2">
            <button onclick = "location.href='4ReviewModification.php'">
                <img src="NewModify.png" alt="Modify Review">
            </button>
            <h3 class = "button">Modify/Delete Review</h3>
        </div>

        <div class = "img3">
            <button onclick = "location.href='8ReviewAnalysis.php'">
                <img src="NewAnalytics.png" alt="Review Analytics">
            </button>
            <h3 class = "button">Review Analytics</h3>
        </div>
        
    </body>
</html>