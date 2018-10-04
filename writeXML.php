<?php
if (session_id() === "") {
    session_start();
}
$newBookingA = [['number'=>'333'],['name'=>'Vasiliy and Family'],[['checkIn']['day']=>'22'],[['checkIn']['month']=>'11'],[['checkIn']['year']=>'2018'],
    [['checkOut']['day']=>'11'],[['checkOut']['month']=>'12'],[['checkOut']['year']=>'2018']];
$newBookings = simplexml_load_file('./rooms/roomBookings.xml');
$newBooking->addChild('number', $room);
$newBooking->addChild('name', $clientName);
$checkIn = $newBooking->addChild('checkIn');
$checkIn->addChild('day',$d1);
$checkIn->addChild('month',$m1);
$checkIn->addChild('year',$y1);
$checkOut = $newBooking->addChild('checkOut');
$checkOut->addChild('day',$d2);
$checkOut->addChild('month',$m2);
$checkOut->addChild('year',$y2);

$newBookings->saveXML('./rooms/roomBookings.xml');
?>
