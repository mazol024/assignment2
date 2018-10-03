<?php
    $scriptList = array('jquery/jquery-3.3.1.min.js', 'showBookings.js', 'cookies.js', 'showHide.js');
    include ('header.php');
?>


<main >
    <h1>All Bookings<br></h1>
    <hr>
    <div id="showbookings">
        <?php
        if(isset($_POST['submit'])){
            $xml=simplexml_load_file("./rooms/roomBookings.xml") or die("Error: Cannot create object");
            print_r($xml);
        } else {
            echo "No Submit";
        }
        ?>
    </div>
<?php include ("footer.php"); ?>