<?php
    $scriptList = array('jquery/jquery-3.3.1.min.js', 'booking.js', 'cookies.js');
    include ('header.php');
?>


<main >

    <h3 style="color: darkblue">
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
/*                echo "<input value='Show Available' name='submit' type='submit' > ";*/
            ?>
            </fieldset>
        </form>
    </div>

    <section id="booking">

    </section>
<?php
if(isset($_POST['submit'])){
    $dayStart = $_POST['dayStart'];
    $dayEnd = $_POST['dayEnd'];
    $monthStart = $_POST['monthStart'];
    $monthEnd = $_POST['monthEnd'];
    $yearStart = $_POST['yearStart'];
    $yearEnd = $_POST['yearEnd'];
    echo "<div style='float: left'>";
    echo "<p style='color: #777777'>Your period: $dayStart/$monthStart/$yearStart - $dayEnd/$monthEnd/$yearEnd</p><br>";
    echo "<form action='writeXML.php' method='post'>";
    echo "<label id='username' for='username'>Please, Enter Your Booking name:</label> 
    <input required type='text' size='35' name='username' id='username'>";
    $xml = simplexml_load_file("./rooms/hotelRooms.xml") or die("Error: Cannot create object");
    echo "<table><tr><th>Room number</th><th>Room Type</th><th>Room Description </th><th>Price per Night</th><th>Book It</th></tr>";
    foreach ($xml as $element){
        $number = $element -> number ;
        $roomType = $element -> roomType ;
        $description = $element -> description ;
        $pricePerNight = $element -> pricePerNight;
        echo  "<tr class='bookingRow'><td>" . $element -> number ;
        echo "</td><td>" . $element -> roomType ;
        echo "</td><td>" . $element -> description ;
        echo "</td><td>" . $element -> pricePerNight ;
        echo "</td><td style='text-align: right'><input type='radio' name='number' value=$number > </td></tr>";
    }
    echo "</table><br>";
    /*echo "<input type='text' hidden name='number' value='$number'>";*/
    echo "<input type='text' hidden name='dayStart' value='$dayStart'>";
    echo "<input type='text' hidden name='monthStart' value='$monthStart'>";
    echo "<input type='text' hidden name='yearStart' value='$yearStart'>";
    echo "<input type='text' hidden name='dayEnd' value='$dayEnd'>";
    echo "<input type='text' hidden name='monthEnd' value='$monthEnd'>";
    echo "<input type='text' hidden name='yearEnd' value='$yearEnd'>";
    echo "<input type='submit' name='submit' value='Finish Booking'><br/>";
    echo "</form></div>";
} else {
}
?>
<?php include ("footer.php"); ?>