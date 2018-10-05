
<?php
$scriptList = array('jquery/jquery-3.3.1.min.js', 'carousel.js');
include ('header.php');
if (session_id() === "") {
    session_start();
}
/*$newBookingA = [['number'=>'333'],['name'=>'Vasiliy and Family'],[['checkIn']['day']=>'22'],[['checkIn']['month']=>'11'],[['checkIn']['year']=>'2018'],
    [['checkOut']['day']=>'11'],[['checkOut']['month']=>'12'],[['checkOut']['year']=>'2018']];

*/
$room = $_POST['number'];
$clientName = $_POST['username'];
$d1 = $_POST['dayStart'];
$m1 = $_POST['monthStart'];
$y1 = $_POST['yearStart'];
$d2 = $_POST['dayEnd'];
$m2 = $_POST['monthEnd'];
$y2 = $_POST['yearEnd'];
$newBookings = simplexml_load_file('./rooms/roomBookings.xml');
$newBooking=$newBookings->addChild('booking');
$newBooking->addChild('number', $room);
$newBooking->addChild('name', $clientName);
$checkIn = $newBooking->addChild('checkin');
$checkIn->addChild('day',$d1);
$checkIn->addChild('month',$m1);
$checkIn->addChild('year',$y1);
$checkOut = $newBooking->addChild('checkout');
$checkOut->addChild('day',$d2);
$checkOut->addChild('month',$m2);
$checkOut->addChild('year',$y2);

$newBookings->saveXML('./rooms/roomBookings.xml');
/*header('Location: index.php');*/
echo "<main>";
echo "<h3><em>Welcome to</em><br> 'Hotel Isabel'.</em></h3><div id='carousel'><div class='descriptionHotel'></div>";
echo "<script>alert('Your Booking Successful!');</script>";
include ('footer.php');
?>
