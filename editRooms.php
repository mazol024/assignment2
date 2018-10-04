<?php
include ('header.php');
echo "<main><h3 style='color: darkblue;text-align: right'><em>Manage Rooms</em><br></h3><hr>";
if (isset($_POST['submit1'])) {
    echo "Writing edits";
    header('Locate: index.php');
}

if (isset($_POST['submit'])) {
    $number = $_POST['number'];
    $rooms = simplexml_load_file("./rooms/hotelRooms.xml");
    $query = $rooms->xpath("hotelRoom[number=$number]");
    echo "<form action='writeChanges.php' method='post'>";
    echo "<table><tr><th>Room number</th><th>Room Type</th><th>Room Description </th><th>Price per Night</th></tr>";
    foreach ($query as $room) {
        echo "<tr class='bookingRow'><td>" . $room->number;
        echo  "</td><td> <input type='text name='roomType' value='" . $room->roomType."'>";
        echo  "</td><td><input type='text name='description' value='" . $room->description."'  size='50'>";
        echo  "</td><td><input type='text name='pricePerNight' value='" . $room->pricePerNight . "' size='7'></td></tr>";
    }
    echo "</table><br>";
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
echo "<input type='submit' name='submit' value='Edit Room Details'><br/>";
echo "</form></div>";
}
include ('footer.php');
?>