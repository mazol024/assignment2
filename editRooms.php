<?php
include ('header.php');
echo "<main><h3 style='color: darkblue;text-align: right'><em>Manage Rooms</em><br></h3><hr>";
/*if (isset($_POST['submit1'])){
    $hotelRooms = simplexml_load_file('./rooms/hotelRooms.xml');
    $query = $hotelRooms->xpath("hotelRoom[number=$number]");
    echo "Query : " . $query->hotelRoom->number;
    foreach ($query as $room) {
        $room->number = $number;
        $room->roomType = $roomType;
        $room->description = $description;
        $room->pricePerNight = $pricePerNight;
        echo "Printing" . $number . $roomType . $description . $pricePerNight;
    }
    $hotelRooms->saveXML('./rooms/hotelRooms.xml');

}*/
if (isset($_POST['insert'])) {

}
if (isset($_POST['delete'])) {
    $number = $_POST['number'];
    $xmlBooking=simplexml_load_file("./rooms/roomBookings.xml") ;
    $query = $xmlBooking->xpath("booking[number=$number]");
    $flag = false;
    foreach ($query as $element){
        if ($element->number == $number) {
            $flag = true;
        }
    }
    if ($flag){
        echo "Booked! ";
    } else {
        echo "Deleting !";
    }

    }
if (isset($_POST['submit'])) {
    $number = $_POST['number'];
    $rooms = simplexml_load_file("./rooms/hotelRooms.xml");
    $query = $rooms->xpath("hotelRoom[number=$number]");
    echo "<form action='writeRoomUpdate.php' method='post'>";
    echo "<table><tr><th>Room number</th><th>Room Type</th><th>Room Description </th><th>Price per Night</th></tr>";
    foreach ($query as $room) {
        $roomType = $room->roomType;
        $description = $room->description;
        $pricePerNight = $room->pricePerNight;
        echo "<tr class='bookingRow'><td>" . $room->number;
        echo  "</td><td><input type='text' name='roomType' value='$roomType'>";
        echo  "</td><td><input type='text' size='50' name='description' value='$description' >";
        echo  "</td><td><input type='text' size='7' name='pricePerNight' value='$pricePerNight'></td></tr>";
    }
    echo "</table><br>";
    echo "<input type='text' name='number' value=$number hidden>";
    echo "<input type='submit' name='submit1' value='Save Changes'><br/>";
    echo "</form></div>";
} else {
echo "<form action='editRooms.php' method='post'>";
$xmlRooms = simplexml_load_file("./rooms/hotelRooms.xml") or die("Error: Cannot create object");
echo "<table><tr><th>Room number</th><th>Room Type</th><th>Room Description </th><th>Price per Night</th><th>Edit</th></tr>";
foreach ($xmlRooms->hotelRoom as $element){
    $number = $element -> number;
    $roomType = $element -> roomType;
    $description = $element -> description;
    $pricePerNight = $element -> pricePerNight;
    echo  "<tr class='bookingRow'><td>" . $number ;
    echo "</td><td>" . $roomType ;
    echo "</td><td>" . $description ;
    echo "</td><td>" . $pricePerNight ;
    echo "</td><td style='text-align: right'><input type='radio' name='number' value=$number> </td></tr>";

}
echo "</table><br>";
echo "<input type='submit' name='submit' value='Edit Room Details'>";
    echo "<input type='submit' name='delete' value='Delete Room'>";echo "<input type='submit' name='insert' value='Add Room'>";
echo "</form></div>";
}
include ('footer.php');
?>