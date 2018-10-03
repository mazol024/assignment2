<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="leaflet/leaflet.css">
    <?php
    if (session_id() === "") {
        session_start();
    }
    $_SESSION["lastPage"] = basename($_SERVER["PHP_SELF"]);
    $currentPage = $_SESSION["lastPage"];
    if (isset($scriptList) && is_array($scriptList)) {
        foreach ($scriptList as $script) {
            echo "<script src='$script'></script>";
        }
    }
    ?>
</head>

<body>

<header>
    <h1>'Hotel Isabel'</h1>
    <h2>
        <div class="topnav">
            <?php
            if ($currentPage === 'index.php') {
                echo "<a class='active' href='index.php'>Home</a>";
            } else {
                echo "<a href='index.php'>Home</a>";
            }
            if ($currentPage === 'rooms.php') {
                echo "<a class='active' href='rooms.php'>Rooms</a>";
            } else {
                echo "<a href='rooms.php'>Rooms</a>";
            }
            if ($currentPage === 'booking.php') {
                echo "<a class='active' href='booking.php'>Bookig</a>";
                echo "<a  href='showBookings.php' style='color: black'>(Admin)</a>";
            } else {
                echo "<a href='booking.php'>Bookig</a>";
            }
            if ($currentPage === 'contact.php') {
                echo "<a class='active' href='contact.php'>Contact</a>";
            } else {
                echo "<a href='contact.php'>Contact</a>";
            } ?>
        </div>
    </h2>

</header>
