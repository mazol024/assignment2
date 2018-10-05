<?php
include ('header.php');
?>
<main>
<?php
if (session_id() === "") {
    session_start();
}
$number = $_POST['number'];
$roomType = $_POST['roomType'];
$description = $_POST['description'];
$pricePerNight = $_POST['pricePerNight'];
$hotelRooms = simplexml_load_file('./rooms/hotelRooms.xml');
$query = $hotelRooms->xpath("hotelRoom[number=$number]");
foreach ($query as $room) {
    $room->number = $number;
    $room->roomType = $roomType;
    $room->description = $description;
    $room->pricePerNight = $pricePerNight;
}
    $hotelRooms->saveXML('./rooms/hotelRooms.xml');
/*header('Location: index.php');*/
echo "<br><h3>Updated...</h3>";
include ('footer.php');
?>
