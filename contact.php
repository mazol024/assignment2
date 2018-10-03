<?php
    $scriptList = array('jquery/jquery-3.3.1.min.js', 'leaflet/leaflet.js', 'map.js');
    include ('header.php');
?>


<main >
    <h3>
        <em>Welcome to</em><br> 'Hotel Isabel'
    </h3>
    <button id="contactbutton">Food/Eat Points</button>
    <button id="attractbutton">Attraction Points</button>

    <section id="map">

    </section>
    <div class="hotel">
        <p>
        <em>Hotel</em> <br>
            10 South King St.
            (01) 490 1234
        </p>
    </div>
    <div class="contact">
        <p>
        <em>Bar</em><br>
            79 South Beretania St.
            (01) 490 2468
        </p>
    </div>
    <div class="contact">
        <p>
        <em>Cafe</em><br>
            561 Kalakaua Av.
            (01) 490 3579
        </p>
    </div>
    <div class="activity">
        <p>
        <em>ART-shop</em><br>
        31 Liona St.
        (01) 493 1579
        </p>
    </div>
    <div class="contact">
        <p>
        <em>Restaurant</em><br>
        613 South King St.
        (01) 492 3579
        </p>
    </div>
    <div class="activity">
        <p>
            <em>Museum</em><br>
            321 Liona St.
            (01) 493 1579
        </p>
    </div>
    <div class="activity">
        <p>
            <em>Gallery</em><br>
            63 South King St.
            (01) 492 3579
        </p>
    </div>
<?php include ("footer.php"); ?>