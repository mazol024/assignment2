<?php
    $scriptList = array('jquery/jquery-3.3.1.min.js', 'booking.js', 'cookies.js');
    include ('header.php');
?>


<main >

    <h3>
        <em>Make Your Booking!</em>
    </h3>
    <div id="calendar" style="float: left">
        <form name="dateChooser" id="dateChooser" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset >
            <legend>Your Booking Dates:</legend>
            <?php
            $currentDay = date("d");
            $currentMonth = date("m");
            $currentYear = date("Y");
            echo "Current date : $currentDay/$currentMonth/$currentYear <br/>";
                echo "<span style='float: right'>Check-In:";
                echo "<select name='dayStart' id='dayStart'>";
                for ($i = 1; $i<31; $i++){
                    echo "<option value='$i' ";
                    echo ($i == intval($currentDay))?' selected ':'';
                    echo ">$i</option>";
                }
                echo "</select>";
                echo "/";
                echo "<select name='monthStart' id='monthStart'>";
                for ($i = 1; $i<13; $i++){
                    echo "<option value='$i'";
                    echo ($i == $currentMonth)?' selected ':'';
                    echo ">$i</option>";
                }
                echo "</select>";
                echo "/";
                echo "<select name='yearStart' id='yearStart'>";
                for ($i = 2018; $i<2020; $i++){
                    echo "<option value='$i'";
                    echo ($i == $currentYear)?' selected ':'';
                    echo ">$i</option>";
            }
            echo "</select></span><br/>";
                echo "<span style='float: right'>Check-Out:";
                echo "<select name='dayEnd' id='dayEnd'>";
                for ($i = 1; $i<31; $i++){
                    echo "<option value='$i' ";
                    echo ($i == intval($currentDay)+1)?' selected ':'';
                    echo ">$i</option>";
                }
                echo "</select>";
                echo "/";
                echo "<select name='monthEnd' id='monthEnd'>";
                for ($i = 1; $i<13; $i++){
                    echo "<option value='$i'";
                    echo ($i == $currentMonth)?' selected ':'';
                    echo ">$i</option>";
                }
                echo "</select>";
                echo "/";
                echo "<select name='yearEnd' id='yearEnd'>";
                for ($i = 2018; $i<2020; $i++){
                    echo "<option value='$i'";
                    echo ($i == $currentYear)?' selected ':'';
                    echo ">$i</option>";
                }
                echo "</select></span>";
                echo "<br/><input value='Show Available' name='submit' type='submit' > ";
            ?>
            </fieldset>
        </form>
    </div>

    <section id="booking">

    </section>
<?php
if(isset($_POST['submit'])){
    echo "<div style='float: left'>";
    $xml=simplexml_load_file("./rooms/roomBookings.xml") or die("Error: Cannot create object");
    print_r($xml);
    echo "</div>";
} else {
    echo "No Submit";
}
?>
<?php include ("footer.php"); ?>