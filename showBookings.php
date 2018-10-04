<?php
$scriptList = array('jquery/jquery-3.3.1.min.js', 'cookies.js', 'showHide.js');
include ('header.php');
?>


    <main >
    <h1 style='color: #777777;text-align: right'>Manage Bookings<br></h1>
    <hr>
    <div id="showbookings">
        <?php
        if (isset($_POST['submit'])) {
        $b=array();
        $b = $_POST['choosenRow'];
        $a = explode("/",$b);
            $xmlBooking=simplexml_load_file("./rooms/roomBookings.xml") or die("Error: Cannot create object");
            foreach ($xmlBooking->booking as $booking) {
                $number = $booking->number;
                $checkin = $booking->checkin;
                $checkout = $booking->checkout;
                if ( $checkin->day == $a[1] && $checkin->month == $a[2] && $checkin->year == $a[3] && $number == $a[0]){
                    /*echo "Find  it " . $a[1] ."/". $a[2]."/". $a[3];*/
                    unset($booking[0]);
                }

            }
            $xmlBooking->saveXML('./rooms/roomBookings.xml');
        }
        ?>
        <form name="admin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        $xml=simplexml_load_file("./rooms/roomBookings.xml") or die("Error: Cannot create object");
        echo "<table><tr><th>Room number</th><th>Client Name</th><th>CheckIn date </th><th>CheckOut date</th><th>Cancel booking</th></tr>";
        foreach ($xml as $element) {
            $number=$element->number;
            $name=$element->name;
            $dayStart=$element->checkin->day;
            $monthStart=$element->checkin->month;
            $yearStart=$element->checkin->year;
            $dayEnd=$element->checkout->day;
            $monthEnd=$element->checkout->month;
            $yearEnd=$element->checkout->year;
            echo "<tr class='bookingRow'><td>" . $number;
            echo "</td><td>" . $name;
            echo "</td><td>" . $dayStart . "/";
            echo $monthStart . "/";
            echo $yearStart;
            echo "</td><td>" . $dayEnd . "/";
            echo $monthEnd . "/";
            echo $yearEnd;
            $a = $number."/".$dayStart."/".$monthStart."/".$yearStart."/".$dayEnd."/".$monthEnd."/".$yearEnd;
            /*$a = json_encode(array("room"=>$number,"day"=>$dayStart,"month"=>$monthStart,"year"=>$yearStart));*/
            echo "</td><td style='text-align: right'><input type='radio' name='choosenRow' value=$a >";
            echo  "</td></tr>";
        }
        echo "</table>";
        echo "<input type='submit' name='submit' value='Cancel Booking'><br/>";
        ?>
        </form>

    </div>
<?php include ("footer.php"); ?>