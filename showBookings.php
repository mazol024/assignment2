<?php
$scriptList = array('jquery/jquery-3.3.1.min.js', 'cookies.js', 'showHide.js');
include ('header.php');
?>


    <main >
    <h1>All Bookings<br></h1>
    <hr>
    <div id="showbookings">
        <?php
        if (isset($_POST['submit'])) {
            echo "Submitted <br>";
            $i = $_POST['booking'];
            echo "Indx: $i<br>";
            $t = $_SESSION['arrayBookings'];
            unset($t[$i]);
            unset($_SESSION['arrayBookings']) ;
            $_SESSION['arrayBookings'] = $t;
        }
        ?>
        <form name="admin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        foreach ($_SESSION['arrayBookings'] as $element) {

            echo $element['indx'] . ":  ";
            $tmp = $element['indx'];
            echo $element['number'] . ";  ";
            echo $element['name'] . ",  from: ";
            echo $element['checkin']['day'] . "/";
            echo $element['checkin']['month'] . "/";
            echo $element['checkin']['year'] . "  to: ";
            echo $element['checkout']['day'] . "/";
            echo $element['checkout']['month'] . "/";
            echo $element['checkout']['year'] . " ";
            echo "<input type='radio' name='booking' value=$tmp ><br/>";
        }
        echo "<input type='submit' name='submit' value='Cancel'><br/>";
        ?>
        </form>

    </div>
<?php include ("footer.php"); ?>