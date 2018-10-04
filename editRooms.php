<?php
include ('header.php');
echo "<main><h1 style='color: #777777;text-align: right'>Manage Rooms<br></h1><hr>";
if (isset($_POST['submit'])) {
    echo "Room number " . $_POST['number'];
} else {
echo "<form action='editRooms.php' method='post'>";
$xmlRooms = simplexml_load_file("./rooms/hotelRooms.xml") or die("Error: Cannot create object");
echo "<table><tr><th>Room number</th><th>Room Type</th><th>Room Description </th><th>Price per Night</th><th>Edit</th></tr>";
foreach ($xmlRooms as $element){
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
echo "<input type='submit' name='submit' value='Edit Room Details'><br/>";
echo "</form></div>";
}
include ('footer.php');
?>