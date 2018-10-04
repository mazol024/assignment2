<?php
$scriptList = array('jquery/jquery-3.3.1.min.js', 'showBookings.js', 'cookies.js', 'showHide.js');
include ('header.php');
?>


    <main >
    <h1>All Bookings<br></h1>
    <hr>
    <div id="showbookings">
        <?php
        foreach ($_SESSION['arrayBookings'] as $element) {
                    echo $element['number'] . ";  ";
                    echo $element['name'] . ",  from: ";
                    echo $element['checkin']['day'] . "/";
                    echo $element['checkin']['month'] . "/";
                    echo $element['checkin']['year'] . "  to: ";
                    echo $element['checkout']['day'] . "/";
                    echo $element['checkout']['month'] . "/";
                    echo $element['checkout']['year'] . "<br>";
        }

        ?>
    </div>
<?php include ("footer.php"); ?>