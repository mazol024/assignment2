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
    $flag = false;
    foreach ($query as $element){
        if ($element->number == $number) {
            $flag = true;
        }
    }
    if ($flag){
        echo "<br><h3>Room Already exists!....</h3>";
        echo "<script>alert('Room already exists!....');</script>";
        /*header('Location: editRooms.php');*/
    } else {

        /*$newRooms = simplexml_load_file('./rooms/hotelRooms.xml');*/
        $newRoom=$hotelRooms->addChild('hotelRoom');
        $newRoom->addChild('number', $number);
        $newRoom->addChild('roomType', $roomType);
        $newRoom->addChild('description', $description);
        $newRoom->addChild('pricePerNight', $pricePerNight);
        $hotelRooms->saveXML('./rooms/hotelRooms.xml');

        echo "<br><h3>Room added...</h3>";
        echo "<script>alert('Room added..');</script>";
      /*  header('Location: editRooms.php');*/
    }
    include ('footer.php');
    ?>
