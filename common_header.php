<?php

$lables = ["Home", "Order", "List of Restaurants", "Customer Service"];
$links = ["/", "Order", "List of Restaurants", "../issues/"];
function mobileMenu()
{
    global $lables;
    global $links;
    echo "<table>
    <tbody>
        ";
    for ($i = 0; $i < count($lables); $i++) {
        echo "<tr><td>
        <a class='btn btn-primary' href='$links[$i]'>
        $lables[$i]
        </a>
        </td></tr>";
    }
    echo "</tbody></table>";
}

function desktopMenu()
{
    global $lables;
    global $links;
    echo "<table>
    <thead>
        <tr>";
    for ($i = 0; $i < count($lables); $i++) {
        echo "<th><a class='btn btn-primary' href='$links[$i]'>$lables[$i]</a></th>";
    }
    echo "</tr></thead></table>";
}

?>

<style>
    .btn {
        margin: 5px 0px;
    }

    .btn-primary, .btn-primary.focus,
    .btn-primary:focus {
        background-color: orange !important;
        border-color: orange !important;
    }

    .btn-secondary {
        color: maroon !important;
    }

    .btn-primary:hover {
        background-color: #f39d00 !important;
    }
</style>

<style>
    #header {
        height: 100px;
        font-size: 100px;
        overflow: hidden;
    }

    #header,
    #menu {
        background-color: #5f0000;
        width: 100vw;
        color: white;
        text-align: center;
    }

    #menu {
        padding-top: 15px;
        font-size: 20px;
    }


    @media screen and (max-width: 600px) {
        #header {
            height: 50px;
            font-size: 50px;
        }

        #menu>center>table {
            display: none;
        }

        #table-mobile {
            display: block;
        }

        #table {
            display: none;
        }
    }

    .content {
        display: none;
    }

    @media screen and (min-width: 600px) {
        #table {
            display: block;
        }

        #table-mobile {
            display: none;
        }
    }

    #menu th {
        padding: 0px 10px;
    }
</style>

<div id="menu">
    <center id="table">
        <?php desktopMenu(); ?>
    </center>
    <center id="table-mobile">
        <button type="button" class="btn btn-success collapsible">Menu</button>
        <div class="content">
            <?php mobileMenu(); ?>
        </div>
    </center>
</div>

<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>

<div id="header">
    HokieHub
</div>